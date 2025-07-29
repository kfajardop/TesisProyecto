<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoDataTable;
use App\DataTables\Scopes\DocumentoScope;
use App\Http\Requests\CreateDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\DocumentoTipo;
use App\Models\ParteInvolucradaCasos;
use App\Models\ParteInvolucradaDocumento;
use App\Models\ParteTipo;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documentos')->only('show');
        $this->middleware('permission:Crear Documentos')->only(['create', 'store']);
        $this->middleware('permission:Editar Documentos')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar Documentos')->only('destroy');
    }

    /**
     * Display a listing of the Documento.
     */
    public function index(DocumentoDataTable $documentoDataTable)
    {
        $scope = new DocumentoScope();
        $documentoDataTable->addScope($scope);

        return $documentoDataTable->render('documentos.index');
    }


    /**
     * Show the form for creating a new Documento.
     */
    public function create()
    {
        $noClientes = Persona::all();
        $clientes = Cliente::all();

        $personas = $clientes->concat($noClientes);

        $documento = new Documento();

        return view('documentos.create', compact('personas', 'documento'));
    }

    /**
     * Store a newly created Documento in storage.
     */
    public function store(Request $request)
    {

        if ($request->tipo_id == DocumentoTipo::PUBLICO) {

            $this->guardarDocumentoPublico($request);
        }
        if ($request->tipo_id == DocumentoTipo::PRIVADO) {

            $this->guardarDocumentoPrivado($request);
        }
        if ($request->tipo_id == DocumentoTipo::ACTA_NOTARIAL) {

            $this->guardarActaNotarial($request);
        }

        flash()->success('Documento guardado.');

        return redirect(route('documentos.index'));
    }

    /**
     * Display the specified Documento.
     */
    public function show($id)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }

        return view('documentos.show')->with('documento', $documento);
    }

    /**
     * Show the form for editing the specified Documento.
     */
    public function edit($id)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }
        $noClientes = Persona::all();
        $clientes = Cliente::all();

        $personas = $clientes->concat($noClientes);

        return view('documentos.edit', compact('documento', 'personas'));
    }

    /**
     * Update the specified Documento in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->tipo_id == DocumentoTipo::PUBLICO) {
            $this->actualizarDocumentoPublico($request, $id);
        }
        if ($request->tipo_id == DocumentoTipo::PRIVADO) {
            $this->actualizarDocumentoPrivado($request, $id);
        }
        if ($request->tipo_id == DocumentoTipo::ACTA_NOTARIAL) {
            $this->actualizarActaNotarial($request, $id);
        }

        flash()->success('Documento actualizado.');
        return redirect(route('documentos.index'));
    }


    /**
     * Remove the specified Documento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            /** @var Documento $documento */
            $documento = Documento::findOrFail($id); // Usar findOrFail por si no existe

            // Eliminar relaciones
            if ($documento->partesInvolucradas()->count() > 0) {
                $documento->partesInvolucradas()->delete();
            }

            if ($documento->tipo_id == DocumentoTipo::PUBLICO) {
                $documento->doctoPublicoDetalles()->delete();
            }
            if ($documento->tipo_id == DocumentoTipo::PRIVADO) {
                $documento->doctoPrivadoDetalles()->delete();
            }
            if ($documento->tipo_id == DocumentoTipo::ACTA_NOTARIAL) {
                $documento->doctoActaDetalles()->delete();
            }

            $documento->delete();

            DB::commit();

            flash()->success('Documento eliminado.');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al eliminar el documento: ' . $e->getMessage());
        }

        return redirect(route('documentos.index'));
    }

    private function syncPersonas(Documento $documento, int $tipoParte, array $personas)
    {
        $nuevasClaves = collect($personas)->map(fn($p) => $p['model_type'].'|'.$p['id'])->toArray();

        $personasActuales = ParteInvolucradaDocumento::where('documento_id', $documento->id)
            ->where('tipo_id', $tipoParte)
            ->get();

        $clavesActuales = $personasActuales->map(fn($p) => $p->model_type.'|'.$p->model_id)->toArray();

        foreach ($personasActuales as $persona) {
            $clave = $persona->model_type.'|'.$persona->model_id;
            if (!in_array($clave, $nuevasClaves)) {
                $persona->delete();
            }
        }

        foreach ($personas as $persona) {
            $clave = $persona['model_type'].'|'.$persona['id'];
            if (!in_array($clave, $clavesActuales)) {
                ParteInvolucradaDocumento::create([
                    'documento_id' => $documento->id,
                    'model_type' => $persona['model_type'],
                    'model_id' => $persona['id'],
                    'tipo_id' => $tipoParte,
                ]);
            }
        }
    }

    private function guardarDocumentoPublico(Request $request)
    {
        try {
            DB::beginTransaction();
            $documento = Documento::create([
                'tipo_id' => $request->tipo_id,
                'estado_id' => $request->estado_id,
                'usuario_id' => Auth::user()->id,
            ]);

            $documento->doctoPublicoDetalles()->create([
                'no_escritura' => $request->no_escritura,
                'fecha_escritura' => $request->fecha_documento,
                'escritura_id' => $request->tipo_escritura_id,
                'comentario' => $request->observaciones,
            ]);


            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento creado', $request->observaciones);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al guardar el documento: '.$e->getMessage());
        }
    }

    private function guardarDocumentoPrivado(Request $request)
    {
        try {
            DB::beginTransaction();
            $documento = Documento::create([
                'tipo_id' => $request->tipo_id,
                'estado_id' => $request->estado_id,
                'usuario_id' => Auth::user()->id,
            ]);

            $documento->doctoPrivadoDetalles()->create([
                'fecha' => $request->fecha_documento,
                'contrato_id' => $request->contrato_id,
                'comentario' => $request->observaciones,
            ]);
            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento creado', $request->observaciones);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al guardar el documento: '.$e->getMessage());
        }
    }

    private function guardarActaNotarial(Request $request)
    {
        try {
            DB::beginTransaction();
            $documento = Documento::create([
                'tipo_id' => $request->tipo_id,
                'estado_id' => $request->estado_id,
                'usuario_id' => Auth::user()->id,
            ]);

            $documento->doctoActaDetalles()->create([
                'notarial_id' => $request->notarial_id,
                'fecha' => $request->fecha_documento,
                'comentario' => $request->observaciones,
            ]);
            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento creado', $request->observaciones);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al guardar el documento: '.$e->getMessage());
        }
    }

    private function actualizarDocumentoPublico(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $documento = Documento::findOrFail($id);
            $documento->update([
                'estado_id' => $request->estado_id,
            ]);

            $detalle = $documento->doctoPublicoDetalles()->first();
            if ($detalle) {
                $detalle->update([
                    'no_escritura' => $request->no_escritura,
                    'fecha_escritura' => $request->fecha_documento,
                    'escritura_id' => $request->tipo_escritura_id,
                    'comentario' => $request->observaciones,
                ]);
            }

            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento actualizado', $request->observaciones);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al actualizar el documento: '.$e->getMessage());
        }
    }

    private function actualizarDocumentoPrivado(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $documento = Documento::findOrFail($id);
            $documento->update([
                'estado_id' => $request->estado_id,
            ]);

            $detalle = $documento->doctoPrivadoDetalles()->first();
            if ($detalle) {
                $detalle->update([
                    'fecha' => $request->fecha_documento,
                    'contrato_id' => $request->contrato_id,
                    'comentario' => $request->observaciones,
                ]);
            }

            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento actualizado', $request->observaciones);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al actualizar el documento: '.$e->getMessage());
        }
    }

    private function actualizarActaNotarial(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $documento = Documento::findOrFail($id);
            $documento->update([
                'estado_id' => $request->estado_id,
            ]);

            $detalle = $documento->doctoActaDetalles()->first();
            if ($detalle) {
                $detalle->update([
                    'notarial_id' => $request->notarial_id,
                    'fecha' => $request->fecha_documento,
                    'comentario' => $request->observaciones,
                ]);
            }

            $this->syncPersonas($documento, ParteTipo::COMPARECIENTE, json_decode($request->input('comparecientes'), true));
            $this->syncPersonas($documento, ParteTipo::INTERVINIENTE, json_decode($request->input('intervinientes'), true));

            $documento->guardarEnBitacora('Documento actualizado', $request->observaciones);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Error al actualizar el acta notarial: '.$e->getMessage());
        }
    }

    public function cambiarEstadoDocumento(Request $request)
    {
        $documento = Documento::find($request->documento_id);

        if (!$documento) {
            flash()->error('Documento no encontrado');
            return redirect()->back();
        }

        $documento->estado_id = $request->nuevo_estado_id;
        $documento->save();

        $documento->guardarEnBitacora('Cambio de estado Documento', $request->observaciones);

        flash()->success('Estado del documento actualizado.');
        return redirect()->back();
    }

}

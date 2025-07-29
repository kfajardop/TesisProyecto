<?php

namespace App\Http\Controllers;

use App\DataTables\AudienciaDataTable;
use App\DataTables\Scopes\AudienciaScope;
use App\Http\Requests\CreateAudienciaRequest;
use App\Http\Requests\UpdateAudienciaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Audiencia;
use App\Models\Caso;
use App\Models\Cliente;
use App\Models\ParteInvolucradaAudiencia;
use App\Models\ParteInvolucradaCasos;
use App\Models\ParteTipo;
use App\Models\Persona;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class AudienciaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Audiencias')->only('show');
        $this->middleware('permission:Crear Audiencias')->only(['create','store']);
        $this->middleware('permission:Editar Audiencias')->only(['edit','update']);
        $this->middleware('permission:Eliminar Audiencias')->only('destroy');
    }
    /**
     * Display a listing of the Audiencia.
     */
    public function index(AudienciaDataTable $audienciaDataTable)
    {
        $scope = new AudienciaScope();
        $audienciaDataTable->addScope($scope);

        return $audienciaDataTable->render('audiencias.index');
    }


    /**
     * Show the form for creating a new Audiencia.
     */
    public function create()
    {
        $noClientes = Persona::all();
        $clientes = Cliente::all();

        $personas = $clientes->concat($noClientes);
        $audiencia = new Audiencia();
        return view('audiencias.create', compact('personas', 'audiencia'));
    }

    /**
     * Store a newly created Audiencia in storage.
     */
    public function store(CreateAudienciaRequest $request)
    {
        $input = $request->all();

        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::create($input);

        $this->syncPersonas($audiencia, ParteTipo::PARTICIPANTE_EN_AUDIENCIA, json_decode($request->input('participantes'), true));

        flash()->success('Audiencia guardado.');

        return redirect(route('audiencias.index'));
    }

    /**
     * Display the specified Audiencia.
     */
    public function show($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        return view('audiencias.show')->with('audiencia', $audiencia);
    }

    /**
     * Show the form for editing the specified Audiencia.
     */
    public function edit($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        $noClientes = Persona::all();
        $clientes = Cliente::all();
        $personas = $clientes->concat($noClientes);

        return view('audiencias.edit')->with(['audiencia' => $audiencia, 'personas' => $personas]);
    }

    /**
     * Update the specified Audiencia in storage.
     */
    public function update($id, Request $request)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        $audiencia->fill($request->all());
        $audiencia->save();

        $this->syncPersonas($audiencia, ParteTipo::PARTICIPANTE_EN_AUDIENCIA, json_decode($request->input('participantes'), true));

        flash()->success('Audiencia actualizado.');

        return redirect(route('audiencias.index'));
    }

    /**
     * Remove the specified Audiencia from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        $audiencia->partesInvolucradas()->delete();

        $audiencia->delete();

        flash()->success('Audiencia eliminado.');

        return redirect(route('audiencias.index'));
    }

    private function syncPersonas(Audiencia $caso, int $tipoParte, array $personas)
    {
        $nuevasClaves = collect($personas)->map(fn($p) => $p['model_type'] . '|' . $p['id'])->toArray();

        $personasActuales = ParteInvolucradaAudiencia::where('audiencia_id', $caso->id)
            ->where('tipo_id', $tipoParte)
            ->get();

        $clavesActuales = $personasActuales->map(fn($p) => $p->model_type . '|' . $p->model_id)->toArray();

        foreach ($personasActuales as $persona) {
            $clave = $persona->model_type . '|' . $persona->model_id;
            if (!in_array($clave, $nuevasClaves)) {
                $persona->delete();
            }
        }

        foreach ($personas as $persona) {
            $clave = $persona['model_type'] . '|' . $persona['id'];
            if (!in_array($clave, $clavesActuales)) {
                ParteInvolucradaAudiencia::create([
                    'audiencia_id' => $caso->id,
                    'model_type' => $persona['model_type'],
                    'model_id' => $persona['id'],
                    'tipo_id' => $tipoParte,
                ]);
            }
        }
    }
}

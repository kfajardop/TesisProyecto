<?php

namespace App\Http\Controllers;

use App\DataTables\CasoDataTable;
use App\Http\Requests\CreateCasoRequest;
use App\Http\Requests\UpdateCasoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso;
use App\Models\CasoFamiliarJuicioDetalle;
use App\Models\CasoPenalEtapa;
use App\Models\CasoTipo;
use App\Models\Cliente;
use App\Models\ParteInvolucradaCasos;
use App\Models\ParteTipo;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Casos')->only('show');
        $this->middleware('permission:Crear Casos')->only(['create', 'store']);
        $this->middleware('permission:Editar Casos')->only(['edit', 'update']);
        $this->middleware('permission:Eliminar Casos')->only('destroy');
    }

    /**
     * Display a listing of the Caso.
     */
    public function index(CasoDataTable $casoDataTable)
    {
        return $casoDataTable->render('casos.index');
    }


    /**
     * Show the form for creating a new Caso.
     */
    public function create()
    {
        $noClientes = Persona::all();
        $clientes = Cliente::all();

        $personas = $clientes->concat($noClientes);

        return view('casos.create', compact('personas'));
    }

    /**
     * Store a newly created Caso in storage.
     */
    public function store(Request $request)
    {

        $caso = Caso::create([
            'tipo_id' => $request->tipo_id,
            'estado_id' => 1,
            'usuario_id' => Auth::user()->id,
        ]);

        if ($request->tipo_id == CasoTipo::FAMILIAR) {
            $caso->familiarJuicioDetalles()
                ->create([
                'nombre' => '', //Preguntar que se guardara aca
                'juicio_etapa_id' => $request->etapa_id,
                'tipo_juicio_id' => $request->tipo_juicio_id,
            ]);

            $personasDemandantes = json_decode($request->input('personas_demandantes'), true);
            $personasDemandadas = json_decode($request->input('personas_demandadas'), true);

            foreach ($personasDemandantes as $index => $personaDemandante) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $personaDemandante['model_type'],
                    'model_id' => $personaDemandante['id'],
                    'tipo_id' => ParteTipo::DEMANDANTE,
                ]);
            }

            foreach ($personasDemandadas as $index => $personaDemandante) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $personaDemandante['model_type'],
                    'model_id' => $personaDemandante['id'],
                    'tipo_id' => ParteTipo::DEMANDADO,
                ]);
            }
        }

        if ($request->tipo_id == CasoTipo::PENAL){
            $caso->penalDetalles()
                ->create([
                    'no_causa' => $request->no_causa,
                    'no_expediente' => $request->no_expediente,
                    'delito_id' => $request->delito_id,
                    'etapa_id' => CasoPenalEtapa::PREPARATORIA,
                ]);

            $visctimas = json_decode($request->input('victimas'), true);
            $victimarios = json_decode($request->input('victimarios'), true);

            foreach ($visctimas as $index => $victima) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $victima['model_type'],
                    'model_id' => $victima['id'],
                    'tipo_id' => ParteTipo::VICTIMA,
                ]);
            }

            foreach ($victimarios as $index => $victimario) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $victimario['model_type'],
                    'model_id' => $victimario['id'],
                    'tipo_id' => ParteTipo::VICTIMARIO,
                ]);
            }

        }

        flash()->success('Caso guardado.');

        return redirect(route('casos.index'));
    }

    /**
     * Display the specified Caso.
     */
    public function show($id)
    {
        /** @var Caso $caso */
        $caso = Caso::find($id);

        if (empty($caso)) {
            flash()->error('Caso no encontrado');

            return redirect(route('casos.index'));
        }

        return view('casos.show')->with('caso', $caso);
    }

    /**
     * Show the form for editing the specified Caso.
     */
    public function edit($id)
    {
        /** @var Caso $caso */
        $caso = Caso::find($id);

        if (empty($caso)) {
            flash()->error('Caso no encontrado');

            return redirect(route('casos.index'));
        }
        $noClientes = Persona::all();
        $clientes = Cliente::all();

        $personas = $clientes->concat($noClientes);

        return view('casos.edit', compact('caso', 'personas'));
    }

    /**
     * Update the specified Caso in storage.
     */
    public function update($id, UpdateCasoRequest $request)
    {
        /** @var Caso $caso */
        $caso = Caso::find($id);

        if (empty($caso)) {
            flash()->error('Caso no encontrado');

            return redirect(route('casos.index'));
        }

        $caso->fill($request->all());
        $caso->save();

        flash()->success('Caso actualizado.');

        return redirect(route('casos.index'));
    }

    /**
     * Remove the specified Caso from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso $caso */
        $caso = Caso::find($id);

        if (empty($caso)) {
            flash()->error('Caso no encontrado');

            return redirect(route('casos.index'));
        }

        $caso->delete();

        flash()->success('Caso eliminado.');

        return redirect(route('casos.index'));
    }
}

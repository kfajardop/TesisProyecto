<?php

namespace App\Http\Controllers;

use App\DataTables\CasoDataTable;
use App\DataTables\Scopes\CasoScope;
use App\Http\Requests\CreateCasoRequest;
use App\Models\Caso;
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
        $scope = new CasoScope();
        $casoDataTable->addScope($scope);

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

        $caso = new Caso();

        return view('casos.create', compact('personas', 'caso'));
    }

    /**
     * Store a newly created Caso in storage.
     */
    public function store(CreateCasoRequest $request)
    {

        $personasAcusadoras = $request->input('personas_demandantes') ?? $request->input('victimas');
        $personasAcusadas = $request->input('personas_demandadas') ?? $request->input('victimarios');

        $resultado = $this->validaTieneMismoTipo($personasAcusadoras, $personasAcusadas);

        if ($resultado['tieneMismoTipo']) {
            return back()->withErrors([
                'personas' => $resultado['message']
            ])->withInput();
        }

        $caso = Caso::create([
            'tipo_id' => $request->tipo_id,
            'estado_id' => 1,
            'usuario_id' => Auth::user()->id,
        ]);

        if ($request->tipo_id == CasoTipo::FAMILIAR) {
            $detalle = $caso->familiarJuicioDetalles()
                ->create([
                    'nombre' => '', //Preguntar que se guardara aca
                    'juicio_etapa_id' => $request->etapa_id,
                    'tipo_juicio_id' => $request->tipo_juicio_id,
                ]);

            $caso->guardarEnBitacora('Caso Familiar Creado, etapa: '.$detalle->etapa->nombre, $request->observaciones);

            foreach ($personasAcusadoras as $index => $personaDemandante) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $personaDemandante['model_type'],
                    'model_id' => $personaDemandante['id'],
                    'tipo_id' => ParteTipo::DEMANDANTE,
                ]);
            }

            foreach ($personasAcusadas as $index => $personaDemandante) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $personaDemandante['model_type'],
                    'model_id' => $personaDemandante['id'],
                    'tipo_id' => ParteTipo::DEMANDADO,
                ]);
            }
        }

        if ($request->tipo_id == CasoTipo::PENAL) {
            $detalle = $caso->penalDetalles()
                ->create([
                    'no_causa' => $request->no_causa,
                    'no_expediente' => $request->no_expediente,
                    'delito_id' => $request->delito_id,
                    'etapa_id' => CasoPenalEtapa::PREPARATORIA,
                ]);

            $caso->guardarEnBitacora('Caso Penal Creado, etapa: '.$detalle->etapa->nombre, $request->observaciones);

            foreach ($personasAcusadoras as $index => $victima) {
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $victima['model_type'],
                    'model_id' => $victima['id'],
                    'tipo_id' => ParteTipo::VICTIMA,
                ]);
            }

            foreach ($personasAcusadas as $index => $victimario) {
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
    public function update(Request $request, $id)
    {
        $caso = Caso::findOrFail($id);

//        $caso->update([
//            'tipo_id' => $request->tipo_id,
//        ]);

        if ($request->tipo_id == CasoTipo::FAMILIAR) {

            $caso->familiarJuicioDetalles()
                ->updateOrCreate(
                    ['caso_id' => $caso->id], // criterios de búsqueda
                    [
                        'nombre' => '', // aún pendiente definir
                        'juicio_etapa_id' => $request->etapa_id,
                        'tipo_juicio_id' => $request->tipo_juicio_id,
                    ]
                );

            $caso->guardarEnBitacora('Caso Familiar Actualizado, etapa: '.$caso->familiarJuicioDetalles()->first()->etapa->nombre, $request->observaciones);

            $this->syncPersonas($caso, ParteTipo::DEMANDANTE,
                json_decode($request->input('personas_demandantes'), true));
            $this->syncPersonas($caso, ParteTipo::DEMANDADO, json_decode($request->input('personas_demandadas'), true));
        }

        if ($request->tipo_id == CasoTipo::PENAL) {
            $caso->penalDetalles()->updateOrCreate(
                ['caso_id' => $caso->id],
                [
                    'no_causa' => $request->no_causa,
                    'no_expediente' => $request->no_expediente,
                    'delito_id' => $request->delito_id,
                    'etapa_id' => $request->etapa_id,
                ]
            );

            $caso->guardarEnBitacora('Caso Penal Actualizado, etapa: '.$caso->penalDetalles()->first()->etapa->nombre, $request->observaciones);

            $this->syncPersonas($caso, ParteTipo::VICTIMA, json_decode($request->input('victimas'), true));
            $this->syncPersonas($caso, ParteTipo::VICTIMARIO, json_decode($request->input('victimarios'), true));
        }

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

    private function syncPersonas(Caso $caso, int $tipoParte, array $personas)
    {
        $nuevasClaves = collect($personas)->map(fn($p) => $p['model_type'] . '|' . $p['id'])->toArray();

        $personasActuales = ParteInvolucradaCasos::where('caso_id', $caso->id)
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
                ParteInvolucradaCasos::create([
                    'caso_id' => $caso->id,
                    'model_type' => $persona['model_type'],
                    'model_id' => $persona['id'],
                    'tipo_id' => $tipoParte,
                ]);
            }
        }
    }

    public function cambiarEtapaCaso(Request $request)
    {
        $caso = Caso::findOrFail($request->caso_id);

        $request->validate([
            'nueva_etapa_id' => 'required|integer',
            'observaciones' => 'nullable|string|max:65535',
        ]);

        if($caso->tipo_id == CasoTipo::FAMILIAR) {
            $caso->familiarJuicioDetalles()->updateOrCreate(
                ['caso_id' => $caso->id],
                [
                    'juicio_etapa_id' => $request->nueva_etapa_id,
                ]
            );

            $caso->guardarEnBitacora('Caso Familiar Actualizado, etapa: '.$caso->familiarJuicioDetalles()->first()->etapa->nombre, $request->observaciones);
        }
        if($caso->tipo_id == CasoTipo::PENAL) {
            $caso->penalDetalles()->updateOrCreate(
                ['caso_id' => $caso->id],
                [
                    'etapa_id' => $request->nueva_etapa_id,
                ]
            );

            $caso->guardarEnBitacora('Caso Penal Actualizado, etapa: '.$caso->penalDetalles()->first()->etapa->nombre, $request->observaciones);
        }

        flash()->success('Caso actualizado.');

        return redirect(route('casos.index'));
    }

    public function validaTieneMismoTipo(array $demandantes, array $demandadas): array
    {
        $demandantesCollection = collect($demandantes);
        $demandadasCollection = collect($demandadas);

        $demandantesIds = $demandantesCollection->pluck('id');
        $demandadasIds = $demandadasCollection->pluck('id');

        $duplicados = $demandantesIds->intersect($demandadasIds);

        if ($duplicados->isNotEmpty()) {
            $nombresDuplicados = $duplicados->map(function ($id) use ($demandantesCollection, $demandadasCollection) {
                // Busca en demandantes primero, luego en demandadas
                $persona = $demandantesCollection->firstWhere('id', $id)
                    ?? $demandadasCollection->firstWhere('id', $id);

                // Devuelve nombre completo si existe, sino el ID
                return $persona['nombre_completo']
                    ?? "{$persona['nombre']} {$persona['apellido']}"
                    ?? "ID {$id}";
            })->unique()->implode(', ');

            return [
                'tieneMismoTipo' => true,
                'message' => "Los siguientes demandantes y demandados son los mismos: {$nombresDuplicados}",
                'personasDuplicadas' => $nombresDuplicados
            ];
        }

        return [
            'tieneMismoTipo' => false,
            'message' => '',
            'personasDuplicadas' => ''
        ];
    }

}

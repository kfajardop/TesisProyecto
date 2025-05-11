<?php

namespace App\Http\Controllers;

use App\DataTables\CasoFamiliarJuicioEtapaDataTable;
use App\Http\Requests\CreateCasoFamiliarJuicioEtapaRequest;
use App\Http\Requests\UpdateCasoFamiliarJuicioEtapaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoFamiliarJuicioEtapa;
use App\Models\CasoFamiliarJuicioTipo;
use Illuminate\Http\Request;

class CasoFamiliarJuicioEtapaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Familiar Juicio Etapas')->only('show');
        $this->middleware('permission:Crear Caso Familiar Juicio Etapas')->only(['create','store']);
        $this->middleware('permission:Editar Caso Familiar Juicio Etapas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Familiar Juicio Etapas')->only('destroy');
    }
    /**
     * Display a listing of the CasoFamiliarJuicioEtapa.
     */
    public function index(CasoFamiliarJuicioEtapaDataTable $casoFamiliarJuicioEtapaDataTable)
    {
    return $casoFamiliarJuicioEtapaDataTable->render('caso_familiar_juicio_etapas.index');
    }


    /**
     * Show the form for creating a new CasoFamiliarJuicioEtapa.
     */
    public function create()
    {
        // ✅ Obtener listado de tipos de juicio
        $tiposJuicio = CasoFamiliarJuicioTipo::pluck('nombre', 'id');

        return view('caso_familiar_juicio_etapas.create', compact('tiposJuicio'));
    }

    /**
     * Store a newly created CasoFamiliarJuicioEtapa in storage.
     */
    public function store(CreateCasoFamiliarJuicioEtapaRequest $request)
    {
        $input = $request->all();

        /** @var CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = CasoFamiliarJuicioEtapa::create($input);

        flash()->success('Caso Familiar Juicio Etapa guardado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }

    /**
     * Display the specified CasoFamiliarJuicioEtapa.
     */
    public function show($id)
    {
        /** @var CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = CasoFamiliarJuicioEtapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso Familiar Juicio Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        return view('caso_familiar_juicio_etapas.show')->with('casoFamiliarJuicioEtapa', $casoFamiliarJuicioEtapa);
    }

    /**
     * Show the form for editing the specified CasoFamiliarJuicioEtapa.
     */
    public function edit($id)
    {
        $casoFamiliarJuicioEtapa = CasoFamiliarJuicioEtapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso Familiar Juicio Etapa no encontrado');
            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        $tiposJuicio = CasoFamiliarJuicioTipo::pluck('nombre', 'id'); // ← Añadido
        return view('caso_familiar_juicio_etapas.edit', compact('casoFamiliarJuicioEtapa', 'tiposJuicio'));
    }


    /**
     * Update the specified CasoFamiliarJuicioEtapa in storage.
     */
    public function update($id, UpdateCasoFamiliarJuicioEtapaRequest $request)
    {
        /** @var CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = CasoFamiliarJuicioEtapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso Familiar Juicio Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        $casoFamiliarJuicioEtapa->fill($request->all());
        $casoFamiliarJuicioEtapa->save();

        flash()->success('Caso Familiar Juicio Etapa actualizado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }

    /**
     * Remove the specified CasoFamiliarJuicioEtapa from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoFamiliarJuicioEtapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = CasoFamiliarJuicioEtapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso Familiar Juicio Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        $casoFamiliarJuicioEtapa->delete();

        flash()->success('Caso Familiar Juicio Etapa eliminado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }
}

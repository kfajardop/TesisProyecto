<?php

namespace App\Http\Controllers;

use App\DataTables\Caso_Familiar_Juicio_EtapaDataTable;
use App\Http\Requests\CreateCaso_Familiar_Juicio_EtapaRequest;
use App\Http\Requests\UpdateCaso_Familiar_Juicio_EtapaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso_Familiar_Juicio_Etapa;
use Illuminate\Http\Request;

class Caso_Familiar_Juicio_EtapaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso  Familiar  Juicio  Etapas')->only('show');
        $this->middleware('permission:Crear Caso  Familiar  Juicio  Etapas')->only(['create','store']);
        $this->middleware('permission:Editar Caso  Familiar  Juicio  Etapas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso  Familiar  Juicio  Etapas')->only('destroy');
    }
    /**
     * Display a listing of the Caso_Familiar_Juicio_Etapa.
     */
    public function index(Caso_Familiar_Juicio_EtapaDataTable $casoFamiliarJuicioEtapaDataTable)
    {
    return $casoFamiliarJuicioEtapaDataTable->render('caso__familiar__juicio__etapas.index');
    }


    /**
     * Show the form for creating a new Caso_Familiar_Juicio_Etapa.
     */
    public function create()
    {
        return view('caso__familiar__juicio__etapas.create');
    }

    /**
     * Store a newly created Caso_Familiar_Juicio_Etapa in storage.
     */
    public function store(CreateCaso_Familiar_Juicio_EtapaRequest $request)
    {
        $input = $request->all();

        /** @var Caso_Familiar_Juicio_Etapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = Caso_Familiar_Juicio_Etapa::create($input);

        flash()->success('Caso  Familiar  Juicio  Etapa guardado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }

    /**
     * Display the specified Caso_Familiar_Juicio_Etapa.
     */
    public function show($id)
    {
        /** @var Caso_Familiar_Juicio_Etapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = Caso_Familiar_Juicio_Etapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso  Familiar  Juicio  Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        return view('caso__familiar__juicio__etapas.show')->with('casoFamiliarJuicioEtapa', $casoFamiliarJuicioEtapa);
    }

    /**
     * Show the form for editing the specified Caso_Familiar_Juicio_Etapa.
     */
    public function edit($id)
    {
        /** @var Caso_Familiar_Juicio_Etapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = Caso_Familiar_Juicio_Etapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso  Familiar  Juicio  Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        return view('caso__familiar__juicio__etapas.edit')->with('casoFamiliarJuicioEtapa', $casoFamiliarJuicioEtapa);
    }

    /**
     * Update the specified Caso_Familiar_Juicio_Etapa in storage.
     */
    public function update($id, UpdateCaso_Familiar_Juicio_EtapaRequest $request)
    {
        /** @var Caso_Familiar_Juicio_Etapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = Caso_Familiar_Juicio_Etapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso  Familiar  Juicio  Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        $casoFamiliarJuicioEtapa->fill($request->all());
        $casoFamiliarJuicioEtapa->save();

        flash()->success('Caso  Familiar  Juicio  Etapa actualizado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }

    /**
     * Remove the specified Caso_Familiar_Juicio_Etapa from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso_Familiar_Juicio_Etapa $casoFamiliarJuicioEtapa */
        $casoFamiliarJuicioEtapa = Caso_Familiar_Juicio_Etapa::find($id);

        if (empty($casoFamiliarJuicioEtapa)) {
            flash()->error('Caso  Familiar  Juicio  Etapa no encontrado');

            return redirect(route('casoFamiliarJuicioEtapas.index'));
        }

        $casoFamiliarJuicioEtapa->delete();

        flash()->success('Caso  Familiar  Juicio  Etapa eliminado.');

        return redirect(route('casoFamiliarJuicioEtapas.index'));
    }
}

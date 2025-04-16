<?php

namespace App\Http\Controllers;

use App\DataTables\Caso_Penal_EtapaDataTable;
use App\Http\Requests\CreateCaso_Penal_EtapaRequest;
use App\Http\Requests\UpdateCaso_Penal_EtapaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso_Penal_Etapa;
use Illuminate\Http\Request;

class Caso_Penal_EtapaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso  Penal  Etapas')->only('show');
        $this->middleware('permission:Crear Caso  Penal  Etapas')->only(['create','store']);
        $this->middleware('permission:Editar Caso  Penal  Etapas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso  Penal  Etapas')->only('destroy');
    }
    /**
     * Display a listing of the Caso_Penal_Etapa.
     */
    public function index(Caso_Penal_EtapaDataTable $casoPenalEtapaDataTable)
    {
    return $casoPenalEtapaDataTable->render('caso__penal__etapas.index');
    }


    /**
     * Show the form for creating a new Caso_Penal_Etapa.
     */
    public function create()
    {
        return view('caso__penal__etapas.create');
    }

    /**
     * Store a newly created Caso_Penal_Etapa in storage.
     */
    public function store(CreateCaso_Penal_EtapaRequest $request)
    {
        $input = $request->all();

        /** @var Caso_Penal_Etapa $casoPenalEtapa */
        $casoPenalEtapa = Caso_Penal_Etapa::create($input);

        flash()->success('Caso  Penal  Etapa guardado.');

        return redirect(route('casoPenalEtapas.index'));
    }

    /**
     * Display the specified Caso_Penal_Etapa.
     */
    public function show($id)
    {
        /** @var Caso_Penal_Etapa $casoPenalEtapa */
        $casoPenalEtapa = Caso_Penal_Etapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso  Penal  Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        return view('caso__penal__etapas.show')->with('casoPenalEtapa', $casoPenalEtapa);
    }

    /**
     * Show the form for editing the specified Caso_Penal_Etapa.
     */
    public function edit($id)
    {
        /** @var Caso_Penal_Etapa $casoPenalEtapa */
        $casoPenalEtapa = Caso_Penal_Etapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso  Penal  Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        return view('caso__penal__etapas.edit')->with('casoPenalEtapa', $casoPenalEtapa);
    }

    /**
     * Update the specified Caso_Penal_Etapa in storage.
     */
    public function update($id, UpdateCaso_Penal_EtapaRequest $request)
    {
        /** @var Caso_Penal_Etapa $casoPenalEtapa */
        $casoPenalEtapa = Caso_Penal_Etapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso  Penal  Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        $casoPenalEtapa->fill($request->all());
        $casoPenalEtapa->save();

        flash()->success('Caso  Penal  Etapa actualizado.');

        return redirect(route('casoPenalEtapas.index'));
    }

    /**
     * Remove the specified Caso_Penal_Etapa from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso_Penal_Etapa $casoPenalEtapa */
        $casoPenalEtapa = Caso_Penal_Etapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso  Penal  Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        $casoPenalEtapa->delete();

        flash()->success('Caso  Penal  Etapa eliminado.');

        return redirect(route('casoPenalEtapas.index'));
    }
}

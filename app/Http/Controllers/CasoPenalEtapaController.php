<?php

namespace App\Http\Controllers;

use App\DataTables\CasoPenalEtapaDataTable;
use App\Http\Requests\CreateCasoPenalEtapaRequest;
use App\Http\Requests\UpdateCasoPenalEtapaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoPenalEtapa;
use Illuminate\Http\Request;

class CasoPenalEtapaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Penal Etapas')->only('show');
        $this->middleware('permission:Crear Caso Penal Etapas')->only(['create','store']);
        $this->middleware('permission:Editar Caso Penal Etapas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Penal Etapas')->only('destroy');
    }
    /**
     * Display a listing of the CasoPenalEtapa.
     */
    public function index(CasoPenalEtapaDataTable $casoPenalEtapaDataTable)
    {
    return $casoPenalEtapaDataTable->render('caso_penal_etapas.index');
    }


    /**
     * Show the form for creating a new CasoPenalEtapa.
     */
    public function create()
    {
        return view('caso_penal_etapas.create');
    }

    /**
     * Store a newly created CasoPenalEtapa in storage.
     */
    public function store(CreateCasoPenalEtapaRequest $request)
    {
        $input = $request->all();

        /** @var CasoPenalEtapa $casoPenalEtapa */
        $casoPenalEtapa = CasoPenalEtapa::create($input);

        flash()->success('Caso Penal Etapa guardado.');

        return redirect(route('casoPenalEtapas.index'));
    }

    /**
     * Display the specified CasoPenalEtapa.
     */
    public function show($id)
    {
        /** @var CasoPenalEtapa $casoPenalEtapa */
        $casoPenalEtapa = CasoPenalEtapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso Penal Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        return view('caso_penal_etapas.show')->with('casoPenalEtapa', $casoPenalEtapa);
    }

    /**
     * Show the form for editing the specified CasoPenalEtapa.
     */
    public function edit($id)
    {
        /** @var CasoPenalEtapa $casoPenalEtapa */
        $casoPenalEtapa = CasoPenalEtapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso Penal Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        return view('caso_penal_etapas.edit')->with('casoPenalEtapa', $casoPenalEtapa);
    }

    /**
     * Update the specified CasoPenalEtapa in storage.
     */
    public function update($id, UpdateCasoPenalEtapaRequest $request)
    {
        /** @var CasoPenalEtapa $casoPenalEtapa */
        $casoPenalEtapa = CasoPenalEtapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso Penal Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        $casoPenalEtapa->fill($request->all());
        $casoPenalEtapa->save();

        flash()->success('Caso Penal Etapa actualizado.');

        return redirect(route('casoPenalEtapas.index'));
    }

    /**
     * Remove the specified CasoPenalEtapa from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoPenalEtapa $casoPenalEtapa */
        $casoPenalEtapa = CasoPenalEtapa::find($id);

        if (empty($casoPenalEtapa)) {
            flash()->error('Caso Penal Etapa no encontrado');

            return redirect(route('casoPenalEtapas.index'));
        }

        $casoPenalEtapa->delete();

        flash()->success('Caso Penal Etapa eliminado.');

        return redirect(route('casoPenalEtapas.index'));
    }
}

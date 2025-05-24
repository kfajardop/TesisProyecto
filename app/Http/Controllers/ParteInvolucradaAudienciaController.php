<?php

namespace App\Http\Controllers;

use App\DataTables\ParteInvolucradaAudienciaDataTable;
use App\Http\Requests\CreateParteInvolucradaAudienciaRequest;
use App\Http\Requests\UpdateParteInvolucradaAudienciaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ParteInvolucradaAudiencia;
use Illuminate\Http\Request;

class ParteInvolucradaAudienciaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Parte Involucrada Audiencias')->only('show');
        $this->middleware('permission:Crear Parte Involucrada Audiencias')->only(['create','store']);
        $this->middleware('permission:Editar Parte Involucrada Audiencias')->only(['edit','update']);
        $this->middleware('permission:Eliminar Parte Involucrada Audiencias')->only('destroy');
    }
    /**
     * Display a listing of the ParteInvolucradaAudiencia.
     */
    public function index(ParteInvolucradaAudienciaDataTable $parteInvolucradaAudienciaDataTable)
    {
    return $parteInvolucradaAudienciaDataTable->render('parte_involucrada_audiencias.index');
    }


    /**
     * Show the form for creating a new ParteInvolucradaAudiencia.
     */
    public function create()
    {
        return view('parte_involucrada_audiencias.create');
    }

    /**
     * Store a newly created ParteInvolucradaAudiencia in storage.
     */
    public function store(CreateParteInvolucradaAudienciaRequest $request)
    {
        $input = $request->all();

        /** @var ParteInvolucradaAudiencia $parteInvolucradaAudiencia */
        $parteInvolucradaAudiencia = ParteInvolucradaAudiencia::create($input);

        flash()->success('Parte Involucrada Audiencia guardado.');

        return redirect(route('parteInvolucradaAudiencias.index'));
    }

    /**
     * Display the specified ParteInvolucradaAudiencia.
     */
    public function show($id)
    {
        /** @var ParteInvolucradaAudiencia $parteInvolucradaAudiencia */
        $parteInvolucradaAudiencia = ParteInvolucradaAudiencia::find($id);

        if (empty($parteInvolucradaAudiencia)) {
            flash()->error('Parte Involucrada Audiencia no encontrado');

            return redirect(route('parteInvolucradaAudiencias.index'));
        }

        return view('parte_involucrada_audiencias.show')->with('parteInvolucradaAudiencia', $parteInvolucradaAudiencia);
    }

    /**
     * Show the form for editing the specified ParteInvolucradaAudiencia.
     */
    public function edit($id)
    {
        /** @var ParteInvolucradaAudiencia $parteInvolucradaAudiencia */
        $parteInvolucradaAudiencia = ParteInvolucradaAudiencia::find($id);

        if (empty($parteInvolucradaAudiencia)) {
            flash()->error('Parte Involucrada Audiencia no encontrado');

            return redirect(route('parteInvolucradaAudiencias.index'));
        }

        return view('parte_involucrada_audiencias.edit')->with('parteInvolucradaAudiencia', $parteInvolucradaAudiencia);
    }

    /**
     * Update the specified ParteInvolucradaAudiencia in storage.
     */
    public function update($id, UpdateParteInvolucradaAudienciaRequest $request)
    {
        /** @var ParteInvolucradaAudiencia $parteInvolucradaAudiencia */
        $parteInvolucradaAudiencia = ParteInvolucradaAudiencia::find($id);

        if (empty($parteInvolucradaAudiencia)) {
            flash()->error('Parte Involucrada Audiencia no encontrado');

            return redirect(route('parteInvolucradaAudiencias.index'));
        }

        $parteInvolucradaAudiencia->fill($request->all());
        $parteInvolucradaAudiencia->save();

        flash()->success('Parte Involucrada Audiencia actualizado.');

        return redirect(route('parteInvolucradaAudiencias.index'));
    }

    /**
     * Remove the specified ParteInvolucradaAudiencia from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ParteInvolucradaAudiencia $parteInvolucradaAudiencia */
        $parteInvolucradaAudiencia = ParteInvolucradaAudiencia::find($id);

        if (empty($parteInvolucradaAudiencia)) {
            flash()->error('Parte Involucrada Audiencia no encontrado');

            return redirect(route('parteInvolucradaAudiencias.index'));
        }

        $parteInvolucradaAudiencia->delete();

        flash()->success('Parte Involucrada Audiencia eliminado.');

        return redirect(route('parteInvolucradaAudiencias.index'));
    }
}

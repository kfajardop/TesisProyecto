<?php

namespace App\Http\Controllers;

use App\DataTables\ParteInvolucradaCasosDataTable;
use App\Http\Requests\CreateParteInvolucradaCasosRequest;
use App\Http\Requests\UpdateParteInvolucradaCasosRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ParteInvolucradaCasos;
use Illuminate\Http\Request;

class ParteInvolucradaCasosController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Parte Involucrada Casos')->only('show');
        $this->middleware('permission:Crear Parte Involucrada Casos')->only(['create','store']);
        $this->middleware('permission:Editar Parte Involucrada Casos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Parte Involucrada Casos')->only('destroy');
    }
    /**
     * Display a listing of the ParteInvolucradaCasos.
     */
    public function index(ParteInvolucradaCasosDataTable $parteInvolucradaCasosDataTable)
    {
    return $parteInvolucradaCasosDataTable->render('parte_involucrada_casos.index');
    }


    /**
     * Show the form for creating a new ParteInvolucradaCasos.
     */
    public function create()
    {
        return view('parte_involucrada_casos.create');
    }

    /**
     * Store a newly created ParteInvolucradaCasos in storage.
     */
    public function store(CreateParteInvolucradaCasosRequest $request)
    {
        $input = $request->all();

        /** @var ParteInvolucradaCasos $parteInvolucradaCasos */
        $parteInvolucradaCasos = ParteInvolucradaCasos::create($input);

        flash()->success('Parte Involucrada Casos guardado.');

        return redirect(route('parteInvolucradaCasos.index'));
    }

    /**
     * Display the specified ParteInvolucradaCasos.
     */
    public function show($id)
    {
        /** @var ParteInvolucradaCasos $parteInvolucradaCasos */
        $parteInvolucradaCasos = ParteInvolucradaCasos::find($id);

        if (empty($parteInvolucradaCasos)) {
            flash()->error('Parte Involucrada Casos no encontrado');

            return redirect(route('parteInvolucradaCasos.index'));
        }

        return view('parte_involucrada_casos.show')->with('parteInvolucradaCasos', $parteInvolucradaCasos);
    }

    /**
     * Show the form for editing the specified ParteInvolucradaCasos.
     */
    public function edit($id)
    {
        /** @var ParteInvolucradaCasos $parteInvolucradaCasos */
        $parteInvolucradaCasos = ParteInvolucradaCasos::find($id);

        if (empty($parteInvolucradaCasos)) {
            flash()->error('Parte Involucrada Casos no encontrado');

            return redirect(route('parteInvolucradaCasos.index'));
        }

        return view('parte_involucrada_casos.edit')->with('parteInvolucradaCasos', $parteInvolucradaCasos);
    }

    /**
     * Update the specified ParteInvolucradaCasos in storage.
     */
    public function update($id, UpdateParteInvolucradaCasosRequest $request)
    {
        /** @var ParteInvolucradaCasos $parteInvolucradaCasos */
        $parteInvolucradaCasos = ParteInvolucradaCasos::find($id);

        if (empty($parteInvolucradaCasos)) {
            flash()->error('Parte Involucrada Casos no encontrado');

            return redirect(route('parteInvolucradaCasos.index'));
        }

        $parteInvolucradaCasos->fill($request->all());
        $parteInvolucradaCasos->save();

        flash()->success('Parte Involucrada Casos actualizado.');

        return redirect(route('parteInvolucradaCasos.index'));
    }

    /**
     * Remove the specified ParteInvolucradaCasos from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ParteInvolucradaCasos $parteInvolucradaCasos */
        $parteInvolucradaCasos = ParteInvolucradaCasos::find($id);

        if (empty($parteInvolucradaCasos)) {
            flash()->error('Parte Involucrada Casos no encontrado');

            return redirect(route('parteInvolucradaCasos.index'));
        }

        $parteInvolucradaCasos->delete();

        flash()->success('Parte Involucrada Casos eliminado.');

        return redirect(route('parteInvolucradaCasos.index'));
    }
}

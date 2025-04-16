<?php

namespace App\Http\Controllers;

use App\DataTables\Tarea_EstadoDataTable;
use App\Http\Requests\CreateTarea_EstadoRequest;
use App\Http\Requests\UpdateTarea_EstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Tarea_Estado;
use Illuminate\Http\Request;

class Tarea_EstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tarea  Estados')->only('show');
        $this->middleware('permission:Crear Tarea  Estados')->only(['create','store']);
        $this->middleware('permission:Editar Tarea  Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Tarea  Estados')->only('destroy');
    }
    /**
     * Display a listing of the Tarea_Estado.
     */
    public function index(Tarea_EstadoDataTable $tareaEstadoDataTable)
    {
    return $tareaEstadoDataTable->render('tarea__estados.index');
    }


    /**
     * Show the form for creating a new Tarea_Estado.
     */
    public function create()
    {
        return view('tarea__estados.create');
    }

    /**
     * Store a newly created Tarea_Estado in storage.
     */
    public function store(CreateTarea_EstadoRequest $request)
    {
        $input = $request->all();

        /** @var Tarea_Estado $tareaEstado */
        $tareaEstado = Tarea_Estado::create($input);

        flash()->success('Tarea  Estado guardado.');

        return redirect(route('tareaEstados.index'));
    }

    /**
     * Display the specified Tarea_Estado.
     */
    public function show($id)
    {
        /** @var Tarea_Estado $tareaEstado */
        $tareaEstado = Tarea_Estado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea  Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        return view('tarea__estados.show')->with('tareaEstado', $tareaEstado);
    }

    /**
     * Show the form for editing the specified Tarea_Estado.
     */
    public function edit($id)
    {
        /** @var Tarea_Estado $tareaEstado */
        $tareaEstado = Tarea_Estado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea  Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        return view('tarea__estados.edit')->with('tareaEstado', $tareaEstado);
    }

    /**
     * Update the specified Tarea_Estado in storage.
     */
    public function update($id, UpdateTarea_EstadoRequest $request)
    {
        /** @var Tarea_Estado $tareaEstado */
        $tareaEstado = Tarea_Estado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea  Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        $tareaEstado->fill($request->all());
        $tareaEstado->save();

        flash()->success('Tarea  Estado actualizado.');

        return redirect(route('tareaEstados.index'));
    }

    /**
     * Remove the specified Tarea_Estado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Tarea_Estado $tareaEstado */
        $tareaEstado = Tarea_Estado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea  Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        $tareaEstado->delete();

        flash()->success('Tarea  Estado eliminado.');

        return redirect(route('tareaEstados.index'));
    }
}

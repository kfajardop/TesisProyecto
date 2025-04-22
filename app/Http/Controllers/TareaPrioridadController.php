<?php

namespace App\Http\Controllers;

use App\DataTables\TareaPrioridadDataTable;
use App\Http\Requests\CreateTareaPrioridadRequest;
use App\Http\Requests\UpdateTareaPrioridadRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TareaPrioridad;
use Illuminate\Http\Request;

class TareaPrioridadController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tarea Prioridads')->only('show');
        $this->middleware('permission:Crear Tarea Prioridads')->only(['create','store']);
        $this->middleware('permission:Editar Tarea Prioridads')->only(['edit','update']);
        $this->middleware('permission:Eliminar Tarea Prioridads')->only('destroy');
    }
    /**
     * Display a listing of the TareaPrioridad.
     */
    public function index(TareaPrioridadDataTable $tareaPrioridadDataTable)
    {
    return $tareaPrioridadDataTable->render('tarea_prioridads.index');
    }


    /**
     * Show the form for creating a new TareaPrioridad.
     */
    public function create()
    {
        return view('tarea_prioridads.create');
    }

    /**
     * Store a newly created TareaPrioridad in storage.
     */
    public function store(CreateTareaPrioridadRequest $request)
    {
        $input = $request->all();

        /** @var TareaPrioridad $tareaPrioridad */
        $tareaPrioridad = TareaPrioridad::create($input);

        flash()->success('Tarea Prioridad guardado.');

        return redirect(route('tareaPrioridads.index'));
    }

    /**
     * Display the specified TareaPrioridad.
     */
    public function show($id)
    {
        /** @var TareaPrioridad $tareaPrioridad */
        $tareaPrioridad = TareaPrioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        return view('tarea_prioridads.show')->with('tareaPrioridad', $tareaPrioridad);
    }

    /**
     * Show the form for editing the specified TareaPrioridad.
     */
    public function edit($id)
    {
        /** @var TareaPrioridad $tareaPrioridad */
        $tareaPrioridad = TareaPrioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        return view('tarea_prioridads.edit')->with('tareaPrioridad', $tareaPrioridad);
    }

    /**
     * Update the specified TareaPrioridad in storage.
     */
    public function update($id, UpdateTareaPrioridadRequest $request)
    {
        /** @var TareaPrioridad $tareaPrioridad */
        $tareaPrioridad = TareaPrioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        $tareaPrioridad->fill($request->all());
        $tareaPrioridad->save();

        flash()->success('Tarea Prioridad actualizado.');

        return redirect(route('tareaPrioridads.index'));
    }

    /**
     * Remove the specified TareaPrioridad from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var TareaPrioridad $tareaPrioridad */
        $tareaPrioridad = TareaPrioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        $tareaPrioridad->delete();

        flash()->success('Tarea Prioridad eliminado.');

        return redirect(route('tareaPrioridads.index'));
    }
}

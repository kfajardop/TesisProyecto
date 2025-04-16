<?php

namespace App\Http\Controllers;

use App\DataTables\Tarea_PrioridadDataTable;
use App\Http\Requests\CreateTarea_PrioridadRequest;
use App\Http\Requests\UpdateTarea_PrioridadRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Tarea_Prioridad;
use Illuminate\Http\Request;

class Tarea_PrioridadController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tarea  Prioridads')->only('show');
        $this->middleware('permission:Crear Tarea  Prioridads')->only(['create','store']);
        $this->middleware('permission:Editar Tarea  Prioridads')->only(['edit','update']);
        $this->middleware('permission:Eliminar Tarea  Prioridads')->only('destroy');
    }
    /**
     * Display a listing of the Tarea_Prioridad.
     */
    public function index(Tarea_PrioridadDataTable $tareaPrioridadDataTable)
    {
    return $tareaPrioridadDataTable->render('tarea__prioridads.index');
    }


    /**
     * Show the form for creating a new Tarea_Prioridad.
     */
    public function create()
    {
        return view('tarea__prioridads.create');
    }

    /**
     * Store a newly created Tarea_Prioridad in storage.
     */
    public function store(CreateTarea_PrioridadRequest $request)
    {
        $input = $request->all();

        /** @var Tarea_Prioridad $tareaPrioridad */
        $tareaPrioridad = Tarea_Prioridad::create($input);

        flash()->success('Tarea  Prioridad guardado.');

        return redirect(route('tareaPrioridads.index'));
    }

    /**
     * Display the specified Tarea_Prioridad.
     */
    public function show($id)
    {
        /** @var Tarea_Prioridad $tareaPrioridad */
        $tareaPrioridad = Tarea_Prioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea  Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        return view('tarea__prioridads.show')->with('tareaPrioridad', $tareaPrioridad);
    }

    /**
     * Show the form for editing the specified Tarea_Prioridad.
     */
    public function edit($id)
    {
        /** @var Tarea_Prioridad $tareaPrioridad */
        $tareaPrioridad = Tarea_Prioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea  Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        return view('tarea__prioridads.edit')->with('tareaPrioridad', $tareaPrioridad);
    }

    /**
     * Update the specified Tarea_Prioridad in storage.
     */
    public function update($id, UpdateTarea_PrioridadRequest $request)
    {
        /** @var Tarea_Prioridad $tareaPrioridad */
        $tareaPrioridad = Tarea_Prioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea  Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        $tareaPrioridad->fill($request->all());
        $tareaPrioridad->save();

        flash()->success('Tarea  Prioridad actualizado.');

        return redirect(route('tareaPrioridads.index'));
    }

    /**
     * Remove the specified Tarea_Prioridad from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Tarea_Prioridad $tareaPrioridad */
        $tareaPrioridad = Tarea_Prioridad::find($id);

        if (empty($tareaPrioridad)) {
            flash()->error('Tarea  Prioridad no encontrado');

            return redirect(route('tareaPrioridads.index'));
        }

        $tareaPrioridad->delete();

        flash()->success('Tarea  Prioridad eliminado.');

        return redirect(route('tareaPrioridads.index'));
    }
}

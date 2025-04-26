<?php

namespace App\Http\Controllers;

use App\DataTables\TareaDataTable;
use App\Http\Requests\CreateTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tareas')->only('show');
        $this->middleware('permission:Crear Tareas')->only(['create','store']);
        $this->middleware('permission:Editar Tareas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Tareas')->only('destroy');
    }
    /**
     * Display a listing of the Tarea.
     */
    public function index(TareaDataTable $tareaDataTable)
    {
    return $tareaDataTable->render('tareas.index');
    }


    /**
     * Show the form for creating a new Tarea.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created Tarea in storage.
     */
    public function store(CreateTareaRequest $request)
    {
        $input = $request->all();

        /** @var Tarea $tarea */
        $tarea = Tarea::create($input);

        flash()->success('Tarea guardado.');

        return redirect(route('tareas.index'));
    }

    /**
     * Display the specified Tarea.
     */
    public function show($id)
    {
        /** @var Tarea $tarea */
        $tarea = Tarea::find($id);

        if (empty($tarea)) {
            flash()->error('Tarea no encontrado');

            return redirect(route('tareas.index'));
        }

        return view('tareas.show')->with('tarea', $tarea);
    }

    /**
     * Show the form for editing the specified Tarea.
     */
    public function edit($id)
    {
        /** @var Tarea $tarea */
        $tarea = Tarea::find($id);

        if (empty($tarea)) {
            flash()->error('Tarea no encontrado');

            return redirect(route('tareas.index'));
        }

        return view('tareas.edit')->with('tarea', $tarea);
    }

    /**
     * Update the specified Tarea in storage.
     */
    public function update($id, UpdateTareaRequest $request)
    {
        /** @var Tarea $tarea */
        $tarea = Tarea::find($id);

        if (empty($tarea)) {
            flash()->error('Tarea no encontrado');

            return redirect(route('tareas.index'));
        }

        $tarea->fill($request->all());
        $tarea->save();

        flash()->success('Tarea actualizado.');

        return redirect(route('tareas.index'));
    }

    /**
     * Remove the specified Tarea from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Tarea $tarea */
        $tarea = Tarea::find($id);

        if (empty($tarea)) {
            flash()->error('Tarea no encontrado');

            return redirect(route('tareas.index'));
        }

        $tarea->delete();

        flash()->success('Tarea eliminado.');

        return redirect(route('tareas.index'));
    }
}

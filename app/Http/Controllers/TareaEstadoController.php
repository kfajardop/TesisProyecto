<?php

namespace App\Http\Controllers;

use App\DataTables\TareaEstadoDataTable;
use App\Http\Requests\CreateTareaEstadoRequest;
use App\Http\Requests\UpdateTareaEstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\TareaEstado;
use Illuminate\Http\Request;

class TareaEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tarea Estados')->only('show');
        $this->middleware('permission:Crear Tarea Estados')->only(['create','store']);
        $this->middleware('permission:Editar Tarea Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Tarea Estados')->only('destroy');
    }
    /**
     * Display a listing of the TareaEstado.
     */
    public function index(TareaEstadoDataTable $tareaEstadoDataTable)
    {
    return $tareaEstadoDataTable->render('tarea_estados.index');
    }


    /**
     * Show the form for creating a new TareaEstado.
     */
    public function create()
    {
        return view('tarea_estados.create');
    }

    /**
     * Store a newly created TareaEstado in storage.
     */
    public function store(CreateTareaEstadoRequest $request)
    {
        $input = $request->all();

        /** @var TareaEstado $tareaEstado */
        $tareaEstado = TareaEstado::create($input);

        flash()->success('Tarea Estado guardado.');

        return redirect(route('tareaEstados.index'));
    }

    /**
     * Display the specified TareaEstado.
     */
    public function show($id)
    {
        /** @var TareaEstado $tareaEstado */
        $tareaEstado = TareaEstado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        return view('tarea_estados.show')->with('tareaEstado', $tareaEstado);
    }

    /**
     * Show the form for editing the specified TareaEstado.
     */
    public function edit($id)
    {
        /** @var TareaEstado $tareaEstado */
        $tareaEstado = TareaEstado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        return view('tarea_estados.edit')->with('tareaEstado', $tareaEstado);
    }

    /**
     * Update the specified TareaEstado in storage.
     */
    public function update($id, UpdateTareaEstadoRequest $request)
    {
        /** @var TareaEstado $tareaEstado */
        $tareaEstado = TareaEstado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        $tareaEstado->fill($request->all());
        $tareaEstado->save();

        flash()->success('Tarea Estado actualizado.');

        return redirect(route('tareaEstados.index'));
    }

    /**
     * Remove the specified TareaEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var TareaEstado $tareaEstado */
        $tareaEstado = TareaEstado::find($id);

        if (empty($tareaEstado)) {
            flash()->error('Tarea Estado no encontrado');

            return redirect(route('tareaEstados.index'));
        }

        $tareaEstado->delete();

        flash()->success('Tarea Estado eliminado.');

        return redirect(route('tareaEstados.index'));
    }
}

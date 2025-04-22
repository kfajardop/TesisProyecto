<?php

namespace App\Http\Controllers;

use App\DataTables\Caso_EstadoDataTable;
use App\Http\Requests\CreateCaso_EstadoRequest;
use App\Http\Requests\UpdateCaso_EstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso_Estado;
use Illuminate\Http\Request;

class Caso_EstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso  Estados')->only('show');
        $this->middleware('permission:Crear Caso  Estados')->only(['create','store']);
        $this->middleware('permission:Editar Caso  Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso  Estados')->only('destroy');
    }
    /**
     * Display a listing of the Caso_Estado.
     */
    public function index(Caso_EstadoDataTable $casoEstadoDataTable)
    {
    return $casoEstadoDataTable->render('caso__estados.index');
    }


    /**
     * Show the form for creating a new Caso_Estado.
     */
    public function create()
    {
        return view('caso__estados.create');
    }

    /**
     * Store a newly created Caso_Estado in storage.
     */
    public function store(CreateCaso_EstadoRequest $request)
    {
        $input = $request->all();

        /** @var Caso_Estado $casoEstado */
        $casoEstado = Caso_Estado::create($input);

        flash()->success('Caso  Estado guardado.');

        return redirect(route('casoEstados.index'));
    }

    /**
     * Display the specified Caso_Estado.
     */
    public function show($id)
    {
        /** @var Caso_Estado $casoEstado */
        $casoEstado = Caso_Estado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso  Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        return view('caso__estados.show')->with('casoEstado', $casoEstado);
    }

    /**
     * Show the form for editing the specified Caso_Estado.
     */
    public function edit($id)
    {
        /** @var Caso_Estado $casoEstado */
        $casoEstado = Caso_Estado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso  Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        return view('caso__estados.edit')->with('casoEstado', $casoEstado);
    }

    /**
     * Update the specified Caso_Estado in storage.
     */
    public function update($id, UpdateCaso_EstadoRequest $request)
    {
        /** @var Caso_Estado $casoEstado */
        $casoEstado = Caso_Estado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso  Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        $casoEstado->fill($request->all());
        $casoEstado->save();

        flash()->success('Caso  Estado actualizado.');

        return redirect(route('casoEstados.index'));
    }

    /**
     * Remove the specified Caso_Estado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso_Estado $casoEstado */
        $casoEstado = Caso_Estado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso  Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        $casoEstado->delete();

        flash()->success('Caso  Estado eliminado.');

        return redirect(route('casoEstados.index'));
    }
}

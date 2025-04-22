<?php

namespace App\Http\Controllers;

use App\DataTables\CasoEstadoDataTable;
use App\Http\Requests\CreateCasoEstadoRequest;
use App\Http\Requests\UpdateCasoEstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoEstado;
use Illuminate\Http\Request;

class CasoEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Estados')->only('show');
        $this->middleware('permission:Crear Caso Estados')->only(['create','store']);
        $this->middleware('permission:Editar Caso Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Estados')->only('destroy');
    }
    /**
     * Display a listing of the CasoEstado.
     */
    public function index(CasoEstadoDataTable $casoEstadoDataTable)
    {
    return $casoEstadoDataTable->render('caso_estados.index');
    }


    /**
     * Show the form for creating a new CasoEstado.
     */
    public function create()
    {
        return view('caso_estados.create');
    }

    /**
     * Store a newly created CasoEstado in storage.
     */
    public function store(CreateCasoEstadoRequest $request)
    {
        $input = $request->all();

        /** @var CasoEstado $casoEstado */
        $casoEstado = CasoEstado::create($input);

        flash()->success('Caso Estado guardado.');

        return redirect(route('casoEstados.index'));
    }

    /**
     * Display the specified CasoEstado.
     */
    public function show($id)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = CasoEstado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        return view('caso_estados.show')->with('casoEstado', $casoEstado);
    }

    /**
     * Show the form for editing the specified CasoEstado.
     */
    public function edit($id)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = CasoEstado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        return view('caso_estados.edit')->with('casoEstado', $casoEstado);
    }

    /**
     * Update the specified CasoEstado in storage.
     */
    public function update($id, UpdateCasoEstadoRequest $request)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = CasoEstado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        $casoEstado->fill($request->all());
        $casoEstado->save();

        flash()->success('Caso Estado actualizado.');

        return redirect(route('casoEstados.index'));
    }

    /**
     * Remove the specified CasoEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoEstado $casoEstado */
        $casoEstado = CasoEstado::find($id);

        if (empty($casoEstado)) {
            flash()->error('Caso Estado no encontrado');

            return redirect(route('casoEstados.index'));
        }

        $casoEstado->delete();

        flash()->success('Caso Estado eliminado.');

        return redirect(route('casoEstados.index'));
    }
}

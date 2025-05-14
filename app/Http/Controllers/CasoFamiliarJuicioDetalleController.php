<?php

namespace App\Http\Controllers;

use App\DataTables\CasoFamiliarJuicioDetalleDataTable;
use App\Http\Requests\CreateCasoFamiliarJuicioDetalleRequest;
use App\Http\Requests\UpdateCasoFamiliarJuicioDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoFamiliarJuicioDetalle;
use Illuminate\Http\Request;

class CasoFamiliarJuicioDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Familiar Juicio Detalles')->only('show');
        $this->middleware('permission:Crear Caso Familiar Juicio Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Caso Familiar Juicio Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Familiar Juicio Detalles')->only('destroy');
    }
    /**
     * Display a listing of the CasoFamiliarJuicioDetalle.
     */
    public function index(CasoFamiliarJuicioDetalleDataTable $casoFamiliarJuicioDetalleDataTable)
    {
    return $casoFamiliarJuicioDetalleDataTable->render('caso_familiar_juicio_detalles.index');
    }


    /**
     * Show the form for creating a new CasoFamiliarJuicioDetalle.
     */
    public function create()
    {
        return view('caso_familiar_juicio_detalles.create');
    }

    /**
     * Store a newly created CasoFamiliarJuicioDetalle in storage.
     */
    public function store(CreateCasoFamiliarJuicioDetalleRequest $request)
    {
        $input = $request->all();

        /** @var CasoFamiliarJuicioDetalle $casoFamiliarJuicioDetalle */
        $casoFamiliarJuicioDetalle = CasoFamiliarJuicioDetalle::create($input);

        flash()->success('Caso Familiar Juicio Detalle guardado.');

        return redirect(route('casoFamiliarJuicioDetalles.index'));
    }

    /**
     * Display the specified CasoFamiliarJuicioDetalle.
     */
    public function show($id)
    {
        /** @var CasoFamiliarJuicioDetalle $casoFamiliarJuicioDetalle */
        $casoFamiliarJuicioDetalle = CasoFamiliarJuicioDetalle::find($id);

        if (empty($casoFamiliarJuicioDetalle)) {
            flash()->error('Caso Familiar Juicio Detalle no encontrado');

            return redirect(route('casoFamiliarJuicioDetalles.index'));
        }

        return view('caso_familiar_juicio_detalles.show')->with('casoFamiliarJuicioDetalle', $casoFamiliarJuicioDetalle);
    }

    /**
     * Show the form for editing the specified CasoFamiliarJuicioDetalle.
     */
    public function edit($id)
    {
        /** @var CasoFamiliarJuicioDetalle $casoFamiliarJuicioDetalle */
        $casoFamiliarJuicioDetalle = CasoFamiliarJuicioDetalle::find($id);

        if (empty($casoFamiliarJuicioDetalle)) {
            flash()->error('Caso Familiar Juicio Detalle no encontrado');

            return redirect(route('casoFamiliarJuicioDetalles.index'));
        }

        return view('caso_familiar_juicio_detalles.edit')->with('casoFamiliarJuicioDetalle', $casoFamiliarJuicioDetalle);
    }

    /**
     * Update the specified CasoFamiliarJuicioDetalle in storage.
     */
    public function update($id, UpdateCasoFamiliarJuicioDetalleRequest $request)
    {
        /** @var CasoFamiliarJuicioDetalle $casoFamiliarJuicioDetalle */
        $casoFamiliarJuicioDetalle = CasoFamiliarJuicioDetalle::find($id);

        if (empty($casoFamiliarJuicioDetalle)) {
            flash()->error('Caso Familiar Juicio Detalle no encontrado');

            return redirect(route('casoFamiliarJuicioDetalles.index'));
        }

        $casoFamiliarJuicioDetalle->fill($request->all());
        $casoFamiliarJuicioDetalle->save();

        flash()->success('Caso Familiar Juicio Detalle actualizado.');

        return redirect(route('casoFamiliarJuicioDetalles.index'));
    }

    /**
     * Remove the specified CasoFamiliarJuicioDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoFamiliarJuicioDetalle $casoFamiliarJuicioDetalle */
        $casoFamiliarJuicioDetalle = CasoFamiliarJuicioDetalle::find($id);

        if (empty($casoFamiliarJuicioDetalle)) {
            flash()->error('Caso Familiar Juicio Detalle no encontrado');

            return redirect(route('casoFamiliarJuicioDetalles.index'));
        }

        $casoFamiliarJuicioDetalle->delete();

        flash()->success('Caso Familiar Juicio Detalle eliminado.');

        return redirect(route('casoFamiliarJuicioDetalles.index'));
    }
}

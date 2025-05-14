<?php

namespace App\Http\Controllers;

use App\DataTables\CasoPenalDetalleDataTable;
use App\Http\Requests\CreateCasoPenalDetalleRequest;
use App\Http\Requests\UpdateCasoPenalDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoPenalDetalle;
use Illuminate\Http\Request;

class CasoPenalDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Penal Detalles')->only('show');
        $this->middleware('permission:Crear Caso Penal Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Caso Penal Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Penal Detalles')->only('destroy');
    }
    /**
     * Display a listing of the CasoPenalDetalle.
     */
    public function index(CasoPenalDetalleDataTable $casoPenalDetalleDataTable)
    {
    return $casoPenalDetalleDataTable->render('caso_penal_detalles.index');
    }


    /**
     * Show the form for creating a new CasoPenalDetalle.
     */
    public function create()
    {
        return view('caso_penal_detalles.create');
    }

    /**
     * Store a newly created CasoPenalDetalle in storage.
     */
    public function store(CreateCasoPenalDetalleRequest $request)
    {
        $input = $request->all();

        /** @var CasoPenalDetalle $casoPenalDetalle */
        $casoPenalDetalle = CasoPenalDetalle::create($input);

        flash()->success('Caso Penal Detalle guardado.');

        return redirect(route('casoPenalDetalles.index'));
    }

    /**
     * Display the specified CasoPenalDetalle.
     */
    public function show($id)
    {
        /** @var CasoPenalDetalle $casoPenalDetalle */
        $casoPenalDetalle = CasoPenalDetalle::find($id);

        if (empty($casoPenalDetalle)) {
            flash()->error('Caso Penal Detalle no encontrado');

            return redirect(route('casoPenalDetalles.index'));
        }

        return view('caso_penal_detalles.show')->with('casoPenalDetalle', $casoPenalDetalle);
    }

    /**
     * Show the form for editing the specified CasoPenalDetalle.
     */
    public function edit($id)
    {
        /** @var CasoPenalDetalle $casoPenalDetalle */
        $casoPenalDetalle = CasoPenalDetalle::find($id);

        if (empty($casoPenalDetalle)) {
            flash()->error('Caso Penal Detalle no encontrado');

            return redirect(route('casoPenalDetalles.index'));
        }

        return view('caso_penal_detalles.edit')->with('casoPenalDetalle', $casoPenalDetalle);
    }

    /**
     * Update the specified CasoPenalDetalle in storage.
     */
    public function update($id, UpdateCasoPenalDetalleRequest $request)
    {
        /** @var CasoPenalDetalle $casoPenalDetalle */
        $casoPenalDetalle = CasoPenalDetalle::find($id);

        if (empty($casoPenalDetalle)) {
            flash()->error('Caso Penal Detalle no encontrado');

            return redirect(route('casoPenalDetalles.index'));
        }

        $casoPenalDetalle->fill($request->all());
        $casoPenalDetalle->save();

        flash()->success('Caso Penal Detalle actualizado.');

        return redirect(route('casoPenalDetalles.index'));
    }

    /**
     * Remove the specified CasoPenalDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoPenalDetalle $casoPenalDetalle */
        $casoPenalDetalle = CasoPenalDetalle::find($id);

        if (empty($casoPenalDetalle)) {
            flash()->error('Caso Penal Detalle no encontrado');

            return redirect(route('casoPenalDetalles.index'));
        }

        $casoPenalDetalle->delete();

        flash()->success('Caso Penal Detalle eliminado.');

        return redirect(route('casoPenalDetalles.index'));
    }
}

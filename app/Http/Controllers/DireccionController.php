<?php

namespace App\Http\Controllers;

use App\DataTables\DireccionDataTable;
use App\Http\Requests\CreateDireccionRequest;
use App\Http\Requests\UpdateDireccionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Direccions')->only('show');
        $this->middleware('permission:Crear Direccions')->only(['create','store']);
        $this->middleware('permission:Editar Direccions')->only(['edit','update']);
        $this->middleware('permission:Eliminar Direccions')->only('destroy');
    }
    /**
     * Display a listing of the Direccion.
     */
    public function index(DireccionDataTable $direccionDataTable)
    {
    return $direccionDataTable->render('direccions.index');
    }


    /**
     * Show the form for creating a new Direccion.
     */
    public function create()
    {
        return view('direccions.create');
    }

    /**
     * Store a newly created Direccion in storage.
     */
    public function store(CreateDireccionRequest $request)
    {
        $input = $request->all();

        /** @var Direccion $direccion */
        $direccion = Direccion::create($input);

        flash()->success('Direccion guardado.');

        return redirect(route('direccions.index'));
    }

    /**
     * Display the specified Direccion.
     */
    public function show($id)
    {
        /** @var Direccion $direccion */
        $direccion = Direccion::find($id);

        if (empty($direccion)) {
            flash()->error('Direccion no encontrado');

            return redirect(route('direccions.index'));
        }

        return view('direccions.show')->with('direccion', $direccion);
    }

    /**
     * Show the form for editing the specified Direccion.
     */
    public function edit($id)
    {
        /** @var Direccion $direccion */
        $direccion = Direccion::find($id);

        if (empty($direccion)) {
            flash()->error('Direccion no encontrado');

            return redirect(route('direccions.index'));
        }

        return view('direccions.edit')->with('direccion', $direccion);
    }

    /**
     * Update the specified Direccion in storage.
     */
    public function update($id, UpdateDireccionRequest $request)
    {
        /** @var Direccion $direccion */
        $direccion = Direccion::find($id);

        if (empty($direccion)) {
            flash()->error('Direccion no encontrado');

            return redirect(route('direccions.index'));
        }

        $direccion->fill($request->all());
        $direccion->save();

        flash()->success('Direccion actualizado.');

        return redirect(route('direccions.index'));
    }

    /**
     * Remove the specified Direccion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Direccion $direccion */
        $direccion = Direccion::find($id);

        if (empty($direccion)) {
            flash()->error('Direccion no encontrado');

            return redirect(route('direccions.index'));
        }

        $direccion->delete();

        flash()->success('Direccion eliminado.');

        return redirect(route('direccions.index'));
    }
}

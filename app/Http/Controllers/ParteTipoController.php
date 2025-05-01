<?php

namespace App\Http\Controllers;

use App\DataTables\ParteTipoDataTable;
use App\Http\Requests\CreateParteTipoRequest;
use App\Http\Requests\UpdateParteTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ParteTipo;
use Illuminate\Http\Request;

class ParteTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Parte Tipos')->only('show');
        $this->middleware('permission:Crear Parte Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Parte Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Parte Tipos')->only('destroy');
    }
    /**
     * Display a listing of the ParteTipo.
     */
    public function index(ParteTipoDataTable $parteTipoDataTable)
    {
    return $parteTipoDataTable->render('parte_tipos.index');
    }


    /**
     * Show the form for creating a new ParteTipo.
     */
    public function create()
    {
        return view('parte_tipos.create');
    }

    /**
     * Store a newly created ParteTipo in storage.
     */
    public function store(CreateParteTipoRequest $request)
    {
        $input = $request->all();

        /** @var ParteTipo $parteTipo */
        $parteTipo = ParteTipo::create($input);

        flash()->success('Parte Tipo guardado.');

        return redirect(route('parteTipos.index'));
    }

    /**
     * Display the specified ParteTipo.
     */
    public function show($id)
    {
        /** @var ParteTipo $parteTipo */
        $parteTipo = ParteTipo::find($id);

        if (empty($parteTipo)) {
            flash()->error('Parte Tipo no encontrado');

            return redirect(route('parteTipos.index'));
        }

        return view('parte_tipos.show')->with('parteTipo', $parteTipo);
    }

    /**
     * Show the form for editing the specified ParteTipo.
     */
    public function edit($id)
    {
        /** @var ParteTipo $parteTipo */
        $parteTipo = ParteTipo::find($id);

        if (empty($parteTipo)) {
            flash()->error('Parte Tipo no encontrado');

            return redirect(route('parteTipos.index'));
        }

        return view('parte_tipos.edit')->with('parteTipo', $parteTipo);
    }

    /**
     * Update the specified ParteTipo in storage.
     */
    public function update($id, UpdateParteTipoRequest $request)
    {
        /** @var ParteTipo $parteTipo */
        $parteTipo = ParteTipo::find($id);

        if (empty($parteTipo)) {
            flash()->error('Parte Tipo no encontrado');

            return redirect(route('parteTipos.index'));
        }

        $parteTipo->fill($request->all());
        $parteTipo->save();

        flash()->success('Parte Tipo actualizado.');

        return redirect(route('parteTipos.index'));
    }

    /**
     * Remove the specified ParteTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ParteTipo $parteTipo */
        $parteTipo = ParteTipo::find($id);

        if (empty($parteTipo)) {
            flash()->error('Parte Tipo no encontrado');

            return redirect(route('parteTipos.index'));
        }

        $parteTipo->delete();

        flash()->success('Parte Tipo eliminado.');

        return redirect(route('parteTipos.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\Caso_TipoDataTable;
use App\Http\Requests\CreateCaso_TipoRequest;
use App\Http\Requests\UpdateCaso_TipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso_Tipo;
use Illuminate\Http\Request;

class Caso_TipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso  Tipos')->only('show');
        $this->middleware('permission:Crear Caso  Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Caso  Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso  Tipos')->only('destroy');
    }
    /**
     * Display a listing of the Caso_Tipo.
     */
    public function index(Caso_TipoDataTable $casoTipoDataTable)
    {
    return $casoTipoDataTable->render('caso__tipos.index');
    }


    /**
     * Show the form for creating a new Caso_Tipo.
     */
    public function create()
    {
        return view('caso__tipos.create');
    }

    /**
     * Store a newly created Caso_Tipo in storage.
     */
    public function store(CreateCaso_TipoRequest $request)
    {
        $input = $request->all();

        /** @var Caso_Tipo $casoTipo */
        $casoTipo = Caso_Tipo::create($input);

        flash()->success('Caso  Tipo guardado.');

        return redirect(route('casoTipos.index'));
    }

    /**
     * Display the specified Caso_Tipo.
     */
    public function show($id)
    {
        /** @var Caso_Tipo $casoTipo */
        $casoTipo = Caso_Tipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso  Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        return view('caso__tipos.show')->with('casoTipo', $casoTipo);
    }

    /**
     * Show the form for editing the specified Caso_Tipo.
     */
    public function edit($id)
    {
        /** @var Caso_Tipo $casoTipo */
        $casoTipo = Caso_Tipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso  Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        return view('caso__tipos.edit')->with('casoTipo', $casoTipo);
    }

    /**
     * Update the specified Caso_Tipo in storage.
     */
    public function update($id, UpdateCaso_TipoRequest $request)
    {
        /** @var Caso_Tipo $casoTipo */
        $casoTipo = Caso_Tipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso  Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        $casoTipo->fill($request->all());
        $casoTipo->save();

        flash()->success('Caso  Tipo actualizado.');

        return redirect(route('casoTipos.index'));
    }

    /**
     * Remove the specified Caso_Tipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso_Tipo $casoTipo */
        $casoTipo = Caso_Tipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso  Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        $casoTipo->delete();

        flash()->success('Caso  Tipo eliminado.');

        return redirect(route('casoTipos.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\CasoTipoDataTable;
use App\Http\Requests\CreateCasoTipoRequest;
use App\Http\Requests\UpdateCasoTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoTipo;
use Illuminate\Http\Request;

class CasoTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Tipos')->only('show');
        $this->middleware('permission:Crear Caso Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Caso Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Tipos')->only('destroy');
    }
    /**
     * Display a listing of the CasoTipo.
     */
    public function index(CasoTipoDataTable $casoTipoDataTable)
    {
    return $casoTipoDataTable->render('caso_tipos.index');
    }


    /**
     * Show the form for creating a new CasoTipo.
     */
    public function create()
    {
        return view('caso_tipos.create');
    }

    /**
     * Store a newly created CasoTipo in storage.
     */
    public function store(CreateCasoTipoRequest $request)
    {
        $input = $request->all();

        /** @var CasoTipo $casoTipo */
        $casoTipo = CasoTipo::create($input);

        flash()->success('Caso Tipo guardado.');

        return redirect(route('casoTipos.index'));
    }

    /**
     * Display the specified CasoTipo.
     */
    public function show($id)
    {
        /** @var CasoTipo $casoTipo */
        $casoTipo = CasoTipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        return view('caso_tipos.show')->with('casoTipo', $casoTipo);
    }

    /**
     * Show the form for editing the specified CasoTipo.
     */
    public function edit($id)
    {
        /** @var CasoTipo $casoTipo */
        $casoTipo = CasoTipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        return view('caso_tipos.edit')->with('casoTipo', $casoTipo);
    }

    /**
     * Update the specified CasoTipo in storage.
     */
    public function update($id, UpdateCasoTipoRequest $request)
    {
        /** @var CasoTipo $casoTipo */
        $casoTipo = CasoTipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        $casoTipo->fill($request->all());
        $casoTipo->save();

        flash()->success('Caso Tipo actualizado.');

        return redirect(route('casoTipos.index'));
    }

    /**
     * Remove the specified CasoTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoTipo $casoTipo */
        $casoTipo = CasoTipo::find($id);

        if (empty($casoTipo)) {
            flash()->error('Caso Tipo no encontrado');

            return redirect(route('casoTipos.index'));
        }

        $casoTipo->delete();

        flash()->success('Caso Tipo eliminado.');

        return redirect(route('casoTipos.index'));
    }
}

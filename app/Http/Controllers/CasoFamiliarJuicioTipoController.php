<?php

namespace App\Http\Controllers;

use App\DataTables\CasoFamiliarJuicioTipoDataTable;
use App\Http\Requests\CreateCasoFamiliarJuicioTipoRequest;
use App\Http\Requests\UpdateCasoFamiliarJuicioTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoFamiliarJuicioTipo;
use Illuminate\Http\Request;

class CasoFamiliarJuicioTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Familiar Juicio Tipos')->only('show');
        $this->middleware('permission:Crear Caso Familiar Juicio Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Caso Familiar Juicio Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Familiar Juicio Tipos')->only('destroy');
    }
    /**
     * Display a listing of the CasoFamiliarJuicioTipo.
     */
    public function index(CasoFamiliarJuicioTipoDataTable $casoFamiliarJuicioTipoDataTable)
    {
    return $casoFamiliarJuicioTipoDataTable->render('caso_familiar_juicio_tipos.index');
    }


    /**
     * Show the form for creating a new CasoFamiliarJuicioTipo.
     */
    public function create()
    {
        return view('caso_familiar_juicio_tipos.create');
    }

    /**
     * Store a newly created CasoFamiliarJuicioTipo in storage.
     */
    public function store(CreateCasoFamiliarJuicioTipoRequest $request)
    {
        $input = $request->all();

        /** @var CasoFamiliarJuicioTipo $casoFamiliarJuicioTipo */
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::create($input);

        flash()->success('Caso Familiar Juicio Tipo guardado.');

        return redirect(route('casoFamiliarJuicioTipos.index'));
    }

    /**
     * Display the specified CasoFamiliarJuicioTipo.
     */
    public function show($id)
    {
        /** @var CasoFamiliarJuicioTipo $casoFamiliarJuicioTipo */
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::find($id);

        if (empty($casoFamiliarJuicioTipo)) {
            flash()->error('Caso Familiar Juicio Tipo no encontrado');

            return redirect(route('casoFamiliarJuicioTipos.index'));
        }

        return view('caso_familiar_juicio_tipos.show')->with('casoFamiliarJuicioTipo', $casoFamiliarJuicioTipo);
    }

    /**
     * Show the form for editing the specified CasoFamiliarJuicioTipo.
     */
    public function edit($id)
    {
        /** @var CasoFamiliarJuicioTipo $casoFamiliarJuicioTipo */
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::find($id);

        if (empty($casoFamiliarJuicioTipo)) {
            flash()->error('Caso Familiar Juicio Tipo no encontrado');

            return redirect(route('casoFamiliarJuicioTipos.index'));
        }

        return view('caso_familiar_juicio_tipos.edit')->with('casoFamiliarJuicioTipo', $casoFamiliarJuicioTipo);
    }

    /**
     * Update the specified CasoFamiliarJuicioTipo in storage.
     */
    public function update($id, UpdateCasoFamiliarJuicioTipoRequest $request)
    {
        /** @var CasoFamiliarJuicioTipo $casoFamiliarJuicioTipo */
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::find($id);

        if (empty($casoFamiliarJuicioTipo)) {
            flash()->error('Caso Familiar Juicio Tipo no encontrado');

            return redirect(route('casoFamiliarJuicioTipos.index'));
        }

        $casoFamiliarJuicioTipo->fill($request->all());
        $casoFamiliarJuicioTipo->save();

        flash()->success('Caso Familiar Juicio Tipo actualizado.');

        return redirect(route('casoFamiliarJuicioTipos.index'));
    }

    /**
     * Remove the specified CasoFamiliarJuicioTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoFamiliarJuicioTipo $casoFamiliarJuicioTipo */
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::find($id);

        if (empty($casoFamiliarJuicioTipo)) {
            flash()->error('Caso Familiar Juicio Tipo no encontrado');

            return redirect(route('casoFamiliarJuicioTipos.index'));
        }

        $casoFamiliarJuicioTipo->delete();

        flash()->success('Caso Familiar Juicio Tipo eliminado.');

        return redirect(route('casoFamiliarJuicioTipos.index'));
    }
}

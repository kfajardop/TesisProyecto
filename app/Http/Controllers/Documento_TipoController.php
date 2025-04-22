<?php

namespace App\Http\Controllers;

use App\DataTables\Documento_TipoDataTable;
use App\Http\Requests\CreateDocumento_TipoRequest;
use App\Http\Requests\UpdateDocumento_TipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Documento_Tipo;
use Illuminate\Http\Request;

class Documento_TipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento  Tipos')->only('show');
        $this->middleware('permission:Crear Documento  Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Documento  Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento  Tipos')->only('destroy');
    }
    /**
     * Display a listing of the Documento_Tipo.
     */
    public function index(Documento_TipoDataTable $documentoTipoDataTable)
    {
    return $documentoTipoDataTable->render('documento__tipos.index');
    }


    /**
     * Show the form for creating a new Documento_Tipo.
     */
    public function create()
    {
        return view('documento__tipos.create');
    }

    /**
     * Store a newly created Documento_Tipo in storage.
     */
    public function store(CreateDocumento_TipoRequest $request)
    {
        $input = $request->all();

        /** @var Documento_Tipo $documentoTipo */
        $documentoTipo = Documento_Tipo::create($input);

        flash()->success('Documento  Tipo guardado.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Display the specified Documento_Tipo.
     */
    public function show($id)
    {
        /** @var Documento_Tipo $documentoTipo */
        $documentoTipo = Documento_Tipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento  Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento__tipos.show')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Show the form for editing the specified Documento_Tipo.
     */
    public function edit($id)
    {
        /** @var Documento_Tipo $documentoTipo */
        $documentoTipo = Documento_Tipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento  Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento__tipos.edit')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Update the specified Documento_Tipo in storage.
     */
    public function update($id, UpdateDocumento_TipoRequest $request)
    {
        /** @var Documento_Tipo $documentoTipo */
        $documentoTipo = Documento_Tipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento  Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->fill($request->all());
        $documentoTipo->save();

        flash()->success('Documento  Tipo actualizado.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Remove the specified Documento_Tipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Documento_Tipo $documentoTipo */
        $documentoTipo = Documento_Tipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento  Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->delete();

        flash()->success('Documento  Tipo eliminado.');

        return redirect(route('documentoTipos.index'));
    }
}

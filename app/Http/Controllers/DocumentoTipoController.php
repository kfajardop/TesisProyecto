<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoTipoDataTable;
use App\Http\Requests\CreateDocumentoTipoRequest;
use App\Http\Requests\UpdateDocumentoTipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DocumentoTipo;
use Illuminate\Http\Request;

class DocumentoTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Tipos')->only('show');
        $this->middleware('permission:Crear Documento Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Documento Tipos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento Tipos')->only('destroy');
    }
    /**
     * Display a listing of the DocumentoTipo.
     */
    public function index(DocumentoTipoDataTable $documentoTipoDataTable)
    {
    return $documentoTipoDataTable->render('documento_tipos.index');
    }


    /**
     * Show the form for creating a new DocumentoTipo.
     */
    public function create()
    {
        return view('documento_tipos.create');
    }

    /**
     * Store a newly created DocumentoTipo in storage.
     */
    public function store(CreateDocumentoTipoRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::create($input);

        flash()->success('Documento Tipo guardado.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Display the specified DocumentoTipo.
     */
    public function show($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento_tipos.show')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Show the form for editing the specified DocumentoTipo.
     */
    public function edit($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento_tipos.edit')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Update the specified DocumentoTipo in storage.
     */
    public function update($id, UpdateDocumentoTipoRequest $request)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->fill($request->all());
        $documentoTipo->save();

        flash()->success('Documento Tipo actualizado.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Remove the specified DocumentoTipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            flash()->error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->delete();

        flash()->success('Documento Tipo eliminado.');

        return redirect(route('documentoTipos.index'));
    }
}

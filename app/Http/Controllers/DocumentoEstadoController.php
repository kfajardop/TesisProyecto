<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoEstadoDataTable;
use App\Http\Requests\CreateDocumentoEstadoRequest;
use App\Http\Requests\UpdateDocumentoEstadoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DocumentoEstado;
use Illuminate\Http\Request;

class DocumentoEstadoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Estados')->only('show');
        $this->middleware('permission:Crear Documento Estados')->only(['create','store']);
        $this->middleware('permission:Editar Documento Estados')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento Estados')->only('destroy');
    }
    /**
     * Display a listing of the DocumentoEstado.
     */
    public function index(DocumentoEstadoDataTable $documentoEstadoDataTable)
    {
    return $documentoEstadoDataTable->render('documento_estados.index');
    }


    /**
     * Show the form for creating a new DocumentoEstado.
     */
    public function create()
    {
        return view('documento_estados.create');
    }

    /**
     * Store a newly created DocumentoEstado in storage.
     */
    public function store(CreateDocumentoEstadoRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoEstado $documentoEstado */
        $documentoEstado = DocumentoEstado::create($input);

        flash()->success('Documento Estado guardado.');

        return redirect(route('documentoEstados.index'));
    }

    /**
     * Display the specified DocumentoEstado.
     */
    public function show($id)
    {
        /** @var DocumentoEstado $documentoEstado */
        $documentoEstado = DocumentoEstado::find($id);

        if (empty($documentoEstado)) {
            flash()->error('Documento Estado no encontrado');

            return redirect(route('documentoEstados.index'));
        }

        return view('documento_estados.show')->with('documentoEstado', $documentoEstado);
    }

    /**
     * Show the form for editing the specified DocumentoEstado.
     */
    public function edit($id)
    {
        /** @var DocumentoEstado $documentoEstado */
        $documentoEstado = DocumentoEstado::find($id);

        if (empty($documentoEstado)) {
            flash()->error('Documento Estado no encontrado');

            return redirect(route('documentoEstados.index'));
        }

        return view('documento_estados.edit')->with('documentoEstado', $documentoEstado);
    }

    /**
     * Update the specified DocumentoEstado in storage.
     */
    public function update($id, UpdateDocumentoEstadoRequest $request)
    {
        /** @var DocumentoEstado $documentoEstado */
        $documentoEstado = DocumentoEstado::find($id);

        if (empty($documentoEstado)) {
            flash()->error('Documento Estado no encontrado');

            return redirect(route('documentoEstados.index'));
        }

        $documentoEstado->fill($request->all());
        $documentoEstado->save();

        flash()->success('Documento Estado actualizado.');

        return redirect(route('documentoEstados.index'));
    }

    /**
     * Remove the specified DocumentoEstado from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DocumentoEstado $documentoEstado */
        $documentoEstado = DocumentoEstado::find($id);

        if (empty($documentoEstado)) {
            flash()->error('Documento Estado no encontrado');

            return redirect(route('documentoEstados.index'));
        }

        $documentoEstado->delete();

        flash()->success('Documento Estado eliminado.');

        return redirect(route('documentoEstados.index'));
    }
}

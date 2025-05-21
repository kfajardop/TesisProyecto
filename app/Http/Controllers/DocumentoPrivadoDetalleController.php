<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoPrivadoDetalleDataTable;
use App\Http\Requests\CreateDocumentoPrivadoDetalleRequest;
use App\Http\Requests\UpdateDocumentoPrivadoDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DocumentoPrivadoDetalle;
use Illuminate\Http\Request;

class DocumentoPrivadoDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Privado Detalles')->only('show');
        $this->middleware('permission:Crear Documento Privado Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Documento Privado Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento Privado Detalles')->only('destroy');
    }
    /**
     * Display a listing of the DocumentoPrivadoDetalle.
     */
    public function index(DocumentoPrivadoDetalleDataTable $documentoPrivadoDetalleDataTable)
    {
    return $documentoPrivadoDetalleDataTable->render('documento_privado_detalles.index');
    }


    /**
     * Show the form for creating a new DocumentoPrivadoDetalle.
     */
    public function create()
    {
        return view('documento_privado_detalles.create');
    }

    /**
     * Store a newly created DocumentoPrivadoDetalle in storage.
     */
    public function store(CreateDocumentoPrivadoDetalleRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoPrivadoDetalle $documentoPrivadoDetalle */
        $documentoPrivadoDetalle = DocumentoPrivadoDetalle::create($input);

        flash()->success('Documento Privado Detalle guardado.');

        return redirect(route('documentoPrivadoDetalles.index'));
    }

    /**
     * Display the specified DocumentoPrivadoDetalle.
     */
    public function show($id)
    {
        /** @var DocumentoPrivadoDetalle $documentoPrivadoDetalle */
        $documentoPrivadoDetalle = DocumentoPrivadoDetalle::find($id);

        if (empty($documentoPrivadoDetalle)) {
            flash()->error('Documento Privado Detalle no encontrado');

            return redirect(route('documentoPrivadoDetalles.index'));
        }

        return view('documento_privado_detalles.show')->with('documentoPrivadoDetalle', $documentoPrivadoDetalle);
    }

    /**
     * Show the form for editing the specified DocumentoPrivadoDetalle.
     */
    public function edit($id)
    {
        /** @var DocumentoPrivadoDetalle $documentoPrivadoDetalle */
        $documentoPrivadoDetalle = DocumentoPrivadoDetalle::find($id);

        if (empty($documentoPrivadoDetalle)) {
            flash()->error('Documento Privado Detalle no encontrado');

            return redirect(route('documentoPrivadoDetalles.index'));
        }

        return view('documento_privado_detalles.edit')->with('documentoPrivadoDetalle', $documentoPrivadoDetalle);
    }

    /**
     * Update the specified DocumentoPrivadoDetalle in storage.
     */
    public function update($id, UpdateDocumentoPrivadoDetalleRequest $request)
    {
        /** @var DocumentoPrivadoDetalle $documentoPrivadoDetalle */
        $documentoPrivadoDetalle = DocumentoPrivadoDetalle::find($id);

        if (empty($documentoPrivadoDetalle)) {
            flash()->error('Documento Privado Detalle no encontrado');

            return redirect(route('documentoPrivadoDetalles.index'));
        }

        $documentoPrivadoDetalle->fill($request->all());
        $documentoPrivadoDetalle->save();

        flash()->success('Documento Privado Detalle actualizado.');

        return redirect(route('documentoPrivadoDetalles.index'));
    }

    /**
     * Remove the specified DocumentoPrivadoDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DocumentoPrivadoDetalle $documentoPrivadoDetalle */
        $documentoPrivadoDetalle = DocumentoPrivadoDetalle::find($id);

        if (empty($documentoPrivadoDetalle)) {
            flash()->error('Documento Privado Detalle no encontrado');

            return redirect(route('documentoPrivadoDetalles.index'));
        }

        $documentoPrivadoDetalle->delete();

        flash()->success('Documento Privado Detalle eliminado.');

        return redirect(route('documentoPrivadoDetalles.index'));
    }
}

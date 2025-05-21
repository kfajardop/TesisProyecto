<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoActaDetalleDataTable;
use App\Http\Requests\CreateDocumentoActaDetalleRequest;
use App\Http\Requests\UpdateDocumentoActaDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DocumentoActaDetalle;
use Illuminate\Http\Request;

class DocumentoActaDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Acta Detalles')->only('show');
        $this->middleware('permission:Crear Documento Acta Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Documento Acta Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento Acta Detalles')->only('destroy');
    }
    /**
     * Display a listing of the DocumentoActaDetalle.
     */
    public function index(DocumentoActaDetalleDataTable $documentoActaDetalleDataTable)
    {
    return $documentoActaDetalleDataTable->render('documento_acta_detalles.index');
    }


    /**
     * Show the form for creating a new DocumentoActaDetalle.
     */
    public function create()
    {
        return view('documento_acta_detalles.create');
    }

    /**
     * Store a newly created DocumentoActaDetalle in storage.
     */
    public function store(CreateDocumentoActaDetalleRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoActaDetalle $documentoActaDetalle */
        $documentoActaDetalle = DocumentoActaDetalle::create($input);

        flash()->success('Documento Acta Detalle guardado.');

        return redirect(route('documentoActaDetalles.index'));
    }

    /**
     * Display the specified DocumentoActaDetalle.
     */
    public function show($id)
    {
        /** @var DocumentoActaDetalle $documentoActaDetalle */
        $documentoActaDetalle = DocumentoActaDetalle::find($id);

        if (empty($documentoActaDetalle)) {
            flash()->error('Documento Acta Detalle no encontrado');

            return redirect(route('documentoActaDetalles.index'));
        }

        return view('documento_acta_detalles.show')->with('documentoActaDetalle', $documentoActaDetalle);
    }

    /**
     * Show the form for editing the specified DocumentoActaDetalle.
     */
    public function edit($id)
    {
        /** @var DocumentoActaDetalle $documentoActaDetalle */
        $documentoActaDetalle = DocumentoActaDetalle::find($id);

        if (empty($documentoActaDetalle)) {
            flash()->error('Documento Acta Detalle no encontrado');

            return redirect(route('documentoActaDetalles.index'));
        }

        return view('documento_acta_detalles.edit')->with('documentoActaDetalle', $documentoActaDetalle);
    }

    /**
     * Update the specified DocumentoActaDetalle in storage.
     */
    public function update($id, UpdateDocumentoActaDetalleRequest $request)
    {
        /** @var DocumentoActaDetalle $documentoActaDetalle */
        $documentoActaDetalle = DocumentoActaDetalle::find($id);

        if (empty($documentoActaDetalle)) {
            flash()->error('Documento Acta Detalle no encontrado');

            return redirect(route('documentoActaDetalles.index'));
        }

        $documentoActaDetalle->fill($request->all());
        $documentoActaDetalle->save();

        flash()->success('Documento Acta Detalle actualizado.');

        return redirect(route('documentoActaDetalles.index'));
    }

    /**
     * Remove the specified DocumentoActaDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DocumentoActaDetalle $documentoActaDetalle */
        $documentoActaDetalle = DocumentoActaDetalle::find($id);

        if (empty($documentoActaDetalle)) {
            flash()->error('Documento Acta Detalle no encontrado');

            return redirect(route('documentoActaDetalles.index'));
        }

        $documentoActaDetalle->delete();

        flash()->success('Documento Acta Detalle eliminado.');

        return redirect(route('documentoActaDetalles.index'));
    }
}

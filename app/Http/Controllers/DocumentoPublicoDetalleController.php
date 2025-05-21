<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoPublicoDetalleDataTable;
use App\Http\Requests\CreateDocumentoPublicoDetalleRequest;
use App\Http\Requests\UpdateDocumentoPublicoDetalleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DocumentoPublicoDetalle;
use Illuminate\Http\Request;

class DocumentoPublicoDetalleController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Publico Detalles')->only('show');
        $this->middleware('permission:Crear Documento Publico Detalles')->only(['create','store']);
        $this->middleware('permission:Editar Documento Publico Detalles')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documento Publico Detalles')->only('destroy');
    }
    /**
     * Display a listing of the DocumentoPublicoDetalle.
     */
    public function index(DocumentoPublicoDetalleDataTable $documentoPublicoDetalleDataTable)
    {
    return $documentoPublicoDetalleDataTable->render('documento_publico_detalles.index');
    }


    /**
     * Show the form for creating a new DocumentoPublicoDetalle.
     */
    public function create()
    {
        return view('documento_publico_detalles.create');
    }

    /**
     * Store a newly created DocumentoPublicoDetalle in storage.
     */
    public function store(CreateDocumentoPublicoDetalleRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoPublicoDetalle $documentoPublicoDetalle */
        $documentoPublicoDetalle = DocumentoPublicoDetalle::create($input);

        flash()->success('Documento Publico Detalle guardado.');

        return redirect(route('documentoPublicoDetalles.index'));
    }

    /**
     * Display the specified DocumentoPublicoDetalle.
     */
    public function show($id)
    {
        /** @var DocumentoPublicoDetalle $documentoPublicoDetalle */
        $documentoPublicoDetalle = DocumentoPublicoDetalle::find($id);

        if (empty($documentoPublicoDetalle)) {
            flash()->error('Documento Publico Detalle no encontrado');

            return redirect(route('documentoPublicoDetalles.index'));
        }

        return view('documento_publico_detalles.show')->with('documentoPublicoDetalle', $documentoPublicoDetalle);
    }

    /**
     * Show the form for editing the specified DocumentoPublicoDetalle.
     */
    public function edit($id)
    {
        /** @var DocumentoPublicoDetalle $documentoPublicoDetalle */
        $documentoPublicoDetalle = DocumentoPublicoDetalle::find($id);

        if (empty($documentoPublicoDetalle)) {
            flash()->error('Documento Publico Detalle no encontrado');

            return redirect(route('documentoPublicoDetalles.index'));
        }

        return view('documento_publico_detalles.edit')->with('documentoPublicoDetalle', $documentoPublicoDetalle);
    }

    /**
     * Update the specified DocumentoPublicoDetalle in storage.
     */
    public function update($id, UpdateDocumentoPublicoDetalleRequest $request)
    {
        /** @var DocumentoPublicoDetalle $documentoPublicoDetalle */
        $documentoPublicoDetalle = DocumentoPublicoDetalle::find($id);

        if (empty($documentoPublicoDetalle)) {
            flash()->error('Documento Publico Detalle no encontrado');

            return redirect(route('documentoPublicoDetalles.index'));
        }

        $documentoPublicoDetalle->fill($request->all());
        $documentoPublicoDetalle->save();

        flash()->success('Documento Publico Detalle actualizado.');

        return redirect(route('documentoPublicoDetalles.index'));
    }

    /**
     * Remove the specified DocumentoPublicoDetalle from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DocumentoPublicoDetalle $documentoPublicoDetalle */
        $documentoPublicoDetalle = DocumentoPublicoDetalle::find($id);

        if (empty($documentoPublicoDetalle)) {
            flash()->error('Documento Publico Detalle no encontrado');

            return redirect(route('documentoPublicoDetalles.index'));
        }

        $documentoPublicoDetalle->delete();

        flash()->success('Documento Publico Detalle eliminado.');

        return redirect(route('documentoPublicoDetalles.index'));
    }
}

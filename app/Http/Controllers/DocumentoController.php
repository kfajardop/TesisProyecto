<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoDataTable;
use App\Http\Requests\CreateDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documentos')->only('show');
        $this->middleware('permission:Crear Documentos')->only(['create','store']);
        $this->middleware('permission:Editar Documentos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Documentos')->only('destroy');
    }
    /**
     * Display a listing of the Documento.
     */
    public function index(DocumentoDataTable $documentoDataTable)
    {
    return $documentoDataTable->render('documentos.index');
    }


    /**
     * Show the form for creating a new Documento.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Store a newly created Documento in storage.
     */
    public function store(CreateDocumentoRequest $request)
    {
        $input = $request->all();

        /** @var Documento $documento */
        $documento = Documento::create($input);

        flash()->success('Documento guardado.');

        return redirect(route('documentos.index'));
    }

    /**
     * Display the specified Documento.
     */
    public function show($id)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }

        return view('documentos.show')->with('documento', $documento);
    }

    /**
     * Show the form for editing the specified Documento.
     */
    public function edit($id)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }

        return view('documentos.edit')->with('documento', $documento);
    }

    /**
     * Update the specified Documento in storage.
     */
    public function update($id, UpdateDocumentoRequest $request)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }

        $documento->fill($request->all());
        $documento->save();

        flash()->success('Documento actualizado.');

        return redirect(route('documentos.index'));
    }

    /**
     * Remove the specified Documento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Documento $documento */
        $documento = Documento::find($id);

        if (empty($documento)) {
            flash()->error('Documento no encontrado');

            return redirect(route('documentos.index'));
        }

        $documento->delete();

        flash()->success('Documento eliminado.');

        return redirect(route('documentos.index'));
    }
}

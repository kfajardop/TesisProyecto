<?php

namespace App\Http\Controllers;

use App\DataTables\ParteInvolucradaDocumentoDataTable;
use App\Http\Requests\CreateParteInvolucradaDocumentoRequest;
use App\Http\Requests\UpdateParteInvolucradaDocumentoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ParteInvolucradaDocumento;
use Illuminate\Http\Request;

class ParteInvolucradaDocumentoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Parte Involucrada Documentos')->only('show');
        $this->middleware('permission:Crear Parte Involucrada Documentos')->only(['create','store']);
        $this->middleware('permission:Editar Parte Involucrada Documentos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Parte Involucrada Documentos')->only('destroy');
    }
    /**
     * Display a listing of the ParteInvolucradaDocumento.
     */
    public function index(ParteInvolucradaDocumentoDataTable $parteInvolucradaDocumentoDataTable)
    {
    return $parteInvolucradaDocumentoDataTable->render('parte_involucrada_documentos.index');
    }


    /**
     * Show the form for creating a new ParteInvolucradaDocumento.
     */
    public function create()
    {
        return view('parte_involucrada_documentos.create');
    }

    /**
     * Store a newly created ParteInvolucradaDocumento in storage.
     */
    public function store(CreateParteInvolucradaDocumentoRequest $request)
    {
        $input = $request->all();

        /** @var ParteInvolucradaDocumento $parteInvolucradaDocumento */
        $parteInvolucradaDocumento = ParteInvolucradaDocumento::create($input);

        flash()->success('Parte Involucrada Documento guardado.');

        return redirect(route('parteInvolucradaDocumentos.index'));
    }

    /**
     * Display the specified ParteInvolucradaDocumento.
     */
    public function show($id)
    {
        /** @var ParteInvolucradaDocumento $parteInvolucradaDocumento */
        $parteInvolucradaDocumento = ParteInvolucradaDocumento::find($id);

        if (empty($parteInvolucradaDocumento)) {
            flash()->error('Parte Involucrada Documento no encontrado');

            return redirect(route('parteInvolucradaDocumentos.index'));
        }

        return view('parte_involucrada_documentos.show')->with('parteInvolucradaDocumento', $parteInvolucradaDocumento);
    }

    /**
     * Show the form for editing the specified ParteInvolucradaDocumento.
     */
    public function edit($id)
    {
        /** @var ParteInvolucradaDocumento $parteInvolucradaDocumento */
        $parteInvolucradaDocumento = ParteInvolucradaDocumento::find($id);

        if (empty($parteInvolucradaDocumento)) {
            flash()->error('Parte Involucrada Documento no encontrado');

            return redirect(route('parteInvolucradaDocumentos.index'));
        }

        return view('parte_involucrada_documentos.edit')->with('parteInvolucradaDocumento', $parteInvolucradaDocumento);
    }

    /**
     * Update the specified ParteInvolucradaDocumento in storage.
     */
    public function update($id, UpdateParteInvolucradaDocumentoRequest $request)
    {
        /** @var ParteInvolucradaDocumento $parteInvolucradaDocumento */
        $parteInvolucradaDocumento = ParteInvolucradaDocumento::find($id);

        if (empty($parteInvolucradaDocumento)) {
            flash()->error('Parte Involucrada Documento no encontrado');

            return redirect(route('parteInvolucradaDocumentos.index'));
        }

        $parteInvolucradaDocumento->fill($request->all());
        $parteInvolucradaDocumento->save();

        flash()->success('Parte Involucrada Documento actualizado.');

        return redirect(route('parteInvolucradaDocumentos.index'));
    }

    /**
     * Remove the specified ParteInvolucradaDocumento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var ParteInvolucradaDocumento $parteInvolucradaDocumento */
        $parteInvolucradaDocumento = ParteInvolucradaDocumento::find($id);

        if (empty($parteInvolucradaDocumento)) {
            flash()->error('Parte Involucrada Documento no encontrado');

            return redirect(route('parteInvolucradaDocumentos.index'));
        }

        $parteInvolucradaDocumento->delete();

        flash()->success('Parte Involucrada Documento eliminado.');

        return redirect(route('parteInvolucradaDocumentos.index'));
    }
}

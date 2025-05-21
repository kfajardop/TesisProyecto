<?php

namespace App\Http\Controllers;

use App\DataTables\BitacoraDocumentoDataTable;
use App\Http\Requests\CreateBitacoraDocumentoRequest;
use App\Http\Requests\UpdateBitacoraDocumentoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\BitacoraDocumento;
use Illuminate\Http\Request;

class BitacoraDocumentoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Bitacora Documentos')->only('show');
        $this->middleware('permission:Crear Bitacora Documentos')->only(['create','store']);
        $this->middleware('permission:Editar Bitacora Documentos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Bitacora Documentos')->only('destroy');
    }
    /**
     * Display a listing of the BitacoraDocumento.
     */
    public function index(BitacoraDocumentoDataTable $bitacoraDocumentoDataTable)
    {
    return $bitacoraDocumentoDataTable->render('bitacora_documentos.index');
    }


    /**
     * Show the form for creating a new BitacoraDocumento.
     */
    public function create()
    {
        return view('bitacora_documentos.create');
    }

    /**
     * Store a newly created BitacoraDocumento in storage.
     */
    public function store(CreateBitacoraDocumentoRequest $request)
    {
        $input = $request->all();

        /** @var BitacoraDocumento $bitacoraDocumento */
        $bitacoraDocumento = BitacoraDocumento::create($input);

        flash()->success('Bitacora Documento guardado.');

        return redirect(route('bitacoraDocumentos.index'));
    }

    /**
     * Display the specified BitacoraDocumento.
     */
    public function show($id)
    {
        /** @var BitacoraDocumento $bitacoraDocumento */
        $bitacoraDocumento = BitacoraDocumento::find($id);

        if (empty($bitacoraDocumento)) {
            flash()->error('Bitacora Documento no encontrado');

            return redirect(route('bitacoraDocumentos.index'));
        }

        return view('bitacora_documentos.show')->with('bitacoraDocumento', $bitacoraDocumento);
    }

    /**
     * Show the form for editing the specified BitacoraDocumento.
     */
    public function edit($id)
    {
        /** @var BitacoraDocumento $bitacoraDocumento */
        $bitacoraDocumento = BitacoraDocumento::find($id);

        if (empty($bitacoraDocumento)) {
            flash()->error('Bitacora Documento no encontrado');

            return redirect(route('bitacoraDocumentos.index'));
        }

        return view('bitacora_documentos.edit')->with('bitacoraDocumento', $bitacoraDocumento);
    }

    /**
     * Update the specified BitacoraDocumento in storage.
     */
    public function update($id, UpdateBitacoraDocumentoRequest $request)
    {
        /** @var BitacoraDocumento $bitacoraDocumento */
        $bitacoraDocumento = BitacoraDocumento::find($id);

        if (empty($bitacoraDocumento)) {
            flash()->error('Bitacora Documento no encontrado');

            return redirect(route('bitacoraDocumentos.index'));
        }

        $bitacoraDocumento->fill($request->all());
        $bitacoraDocumento->save();

        flash()->success('Bitacora Documento actualizado.');

        return redirect(route('bitacoraDocumentos.index'));
    }

    /**
     * Remove the specified BitacoraDocumento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var BitacoraDocumento $bitacoraDocumento */
        $bitacoraDocumento = BitacoraDocumento::find($id);

        if (empty($bitacoraDocumento)) {
            flash()->error('Bitacora Documento no encontrado');

            return redirect(route('bitacoraDocumentos.index'));
        }

        $bitacoraDocumento->delete();

        flash()->success('Bitacora Documento eliminado.');

        return redirect(route('bitacoraDocumentos.index'));
    }
}

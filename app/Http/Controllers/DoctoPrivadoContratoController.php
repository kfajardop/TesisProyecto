<?php

namespace App\Http\Controllers;

use App\DataTables\DoctoPrivadoContratoDataTable;
use App\Http\Requests\CreateDoctoPrivadoContratoRequest;
use App\Http\Requests\UpdateDoctoPrivadoContratoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DoctoPrivadoContrato;
use Illuminate\Http\Request;

class DoctoPrivadoContratoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Docto Privado Contratos')->only('show');
        $this->middleware('permission:Crear Docto Privado Contratos')->only(['create','store']);
        $this->middleware('permission:Editar Docto Privado Contratos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Docto Privado Contratos')->only('destroy');
    }
    /**
     * Display a listing of the DoctoPrivadoContrato.
     */
    public function index(DoctoPrivadoContratoDataTable $doctoPrivadoContratoDataTable)
    {
    return $doctoPrivadoContratoDataTable->render('docto_privado_contratos.index');
    }


    /**
     * Show the form for creating a new DoctoPrivadoContrato.
     */
    public function create()
    {
        return view('docto_privado_contratos.create');
    }

    /**
     * Store a newly created DoctoPrivadoContrato in storage.
     */
    public function store(CreateDoctoPrivadoContratoRequest $request)
    {
        $input = $request->all();

        /** @var DoctoPrivadoContrato $doctoPrivadoContrato */
        $doctoPrivadoContrato = DoctoPrivadoContrato::create($input);

        flash()->success('Docto Privado Contrato guardado.');

        return redirect(route('doctoPrivadoContratos.index'));
    }

    /**
     * Display the specified DoctoPrivadoContrato.
     */
    public function show($id)
    {
        /** @var DoctoPrivadoContrato $doctoPrivadoContrato */
        $doctoPrivadoContrato = DoctoPrivadoContrato::find($id);

        if (empty($doctoPrivadoContrato)) {
            flash()->error('Docto Privado Contrato no encontrado');

            return redirect(route('doctoPrivadoContratos.index'));
        }

        return view('docto_privado_contratos.show')->with('doctoPrivadoContrato', $doctoPrivadoContrato);
    }

    /**
     * Show the form for editing the specified DoctoPrivadoContrato.
     */
    public function edit($id)
    {
        /** @var DoctoPrivadoContrato $doctoPrivadoContrato */
        $doctoPrivadoContrato = DoctoPrivadoContrato::find($id);

        if (empty($doctoPrivadoContrato)) {
            flash()->error('Docto Privado Contrato no encontrado');

            return redirect(route('doctoPrivadoContratos.index'));
        }

        return view('docto_privado_contratos.edit')->with('doctoPrivadoContrato', $doctoPrivadoContrato);
    }

    /**
     * Update the specified DoctoPrivadoContrato in storage.
     */
    public function update($id, UpdateDoctoPrivadoContratoRequest $request)
    {
        /** @var DoctoPrivadoContrato $doctoPrivadoContrato */
        $doctoPrivadoContrato = DoctoPrivadoContrato::find($id);

        if (empty($doctoPrivadoContrato)) {
            flash()->error('Docto Privado Contrato no encontrado');

            return redirect(route('doctoPrivadoContratos.index'));
        }

        $doctoPrivadoContrato->fill($request->all());
        $doctoPrivadoContrato->save();

        flash()->success('Docto Privado Contrato actualizado.');

        return redirect(route('doctoPrivadoContratos.index'));
    }

    /**
     * Remove the specified DoctoPrivadoContrato from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DoctoPrivadoContrato $doctoPrivadoContrato */
        $doctoPrivadoContrato = DoctoPrivadoContrato::find($id);

        if (empty($doctoPrivadoContrato)) {
            flash()->error('Docto Privado Contrato no encontrado');

            return redirect(route('doctoPrivadoContratos.index'));
        }

        $doctoPrivadoContrato->delete();

        flash()->success('Docto Privado Contrato eliminado.');

        return redirect(route('doctoPrivadoContratos.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\DoctoPublicoEscrituraDataTable;
use App\Http\Requests\CreateDoctoPublicoEscrituraRequest;
use App\Http\Requests\UpdateDoctoPublicoEscrituraRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DoctoPublicoEscritura;
use Illuminate\Http\Request;

class DoctoPublicoEscrituraController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Docto Publico Escrituras')->only('show');
        $this->middleware('permission:Crear Docto Publico Escrituras')->only(['create','store']);
        $this->middleware('permission:Editar Docto Publico Escrituras')->only(['edit','update']);
        $this->middleware('permission:Eliminar Docto Publico Escrituras')->only('destroy');
    }
    /**
     * Display a listing of the DoctoPublicoEscritura.
     */
    public function index(DoctoPublicoEscrituraDataTable $doctoPublicoEscrituraDataTable)
    {
    return $doctoPublicoEscrituraDataTable->render('docto_publico_escrituras.index');
    }


    /**
     * Show the form for creating a new DoctoPublicoEscritura.
     */
    public function create()
    {
        return view('docto_publico_escrituras.create');
    }

    /**
     * Store a newly created DoctoPublicoEscritura in storage.
     */
    public function store(CreateDoctoPublicoEscrituraRequest $request)
    {
        $input = $request->all();

        /** @var DoctoPublicoEscritura $doctoPublicoEscritura */
        $doctoPublicoEscritura = DoctoPublicoEscritura::create($input);

        flash()->success('Docto Publico Escritura guardado.');

        return redirect(route('doctoPublicoEscrituras.index'));
    }

    /**
     * Display the specified DoctoPublicoEscritura.
     */
    public function show($id)
    {
        /** @var DoctoPublicoEscritura $doctoPublicoEscritura */
        $doctoPublicoEscritura = DoctoPublicoEscritura::find($id);

        if (empty($doctoPublicoEscritura)) {
            flash()->error('Docto Publico Escritura no encontrado');

            return redirect(route('doctoPublicoEscrituras.index'));
        }

        return view('docto_publico_escrituras.show')->with('doctoPublicoEscritura', $doctoPublicoEscritura);
    }

    /**
     * Show the form for editing the specified DoctoPublicoEscritura.
     */
    public function edit($id)
    {
        /** @var DoctoPublicoEscritura $doctoPublicoEscritura */
        $doctoPublicoEscritura = DoctoPublicoEscritura::find($id);

        if (empty($doctoPublicoEscritura)) {
            flash()->error('Docto Publico Escritura no encontrado');

            return redirect(route('doctoPublicoEscrituras.index'));
        }

        return view('docto_publico_escrituras.edit')->with('doctoPublicoEscritura', $doctoPublicoEscritura);
    }

    /**
     * Update the specified DoctoPublicoEscritura in storage.
     */
    public function update($id, UpdateDoctoPublicoEscrituraRequest $request)
    {
        /** @var DoctoPublicoEscritura $doctoPublicoEscritura */
        $doctoPublicoEscritura = DoctoPublicoEscritura::find($id);

        if (empty($doctoPublicoEscritura)) {
            flash()->error('Docto Publico Escritura no encontrado');

            return redirect(route('doctoPublicoEscrituras.index'));
        }

        $doctoPublicoEscritura->fill($request->all());
        $doctoPublicoEscritura->save();

        flash()->success('Docto Publico Escritura actualizado.');

        return redirect(route('doctoPublicoEscrituras.index'));
    }

    /**
     * Remove the specified DoctoPublicoEscritura from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DoctoPublicoEscritura $doctoPublicoEscritura */
        $doctoPublicoEscritura = DoctoPublicoEscritura::find($id);

        if (empty($doctoPublicoEscritura)) {
            flash()->error('Docto Publico Escritura no encontrado');

            return redirect(route('doctoPublicoEscrituras.index'));
        }

        $doctoPublicoEscritura->delete();

        flash()->success('Docto Publico Escritura eliminado.');

        return redirect(route('doctoPublicoEscrituras.index'));
    }
}

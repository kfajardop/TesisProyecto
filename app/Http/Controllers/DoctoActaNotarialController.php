<?php

namespace App\Http\Controllers;

use App\DataTables\DoctoActaNotarialDataTable;
use App\Http\Requests\CreateDoctoActaNotarialRequest;
use App\Http\Requests\UpdateDoctoActaNotarialRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DoctoActaNotarial;
use Illuminate\Http\Request;

class DoctoActaNotarialController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Docto Acta Notarials')->only('show');
        $this->middleware('permission:Crear Docto Acta Notarials')->only(['create','store']);
        $this->middleware('permission:Editar Docto Acta Notarials')->only(['edit','update']);
        $this->middleware('permission:Eliminar Docto Acta Notarials')->only('destroy');
    }
    /**
     * Display a listing of the DoctoActaNotarial.
     */
    public function index(DoctoActaNotarialDataTable $doctoActaNotarialDataTable)
    {
    return $doctoActaNotarialDataTable->render('docto_acta_notarials.index');
    }


    /**
     * Show the form for creating a new DoctoActaNotarial.
     */
    public function create()
    {
        return view('docto_acta_notarials.create');
    }

    /**
     * Store a newly created DoctoActaNotarial in storage.
     */
    public function store(CreateDoctoActaNotarialRequest $request)
    {
        $input = $request->all();

        /** @var DoctoActaNotarial $doctoActaNotarial */
        $doctoActaNotarial = DoctoActaNotarial::create($input);

        flash()->success('Docto Acta Notarial guardado.');

        return redirect(route('doctoActaNotarials.index'));
    }

    /**
     * Display the specified DoctoActaNotarial.
     */
    public function show($id)
    {
        /** @var DoctoActaNotarial $doctoActaNotarial */
        $doctoActaNotarial = DoctoActaNotarial::find($id);

        if (empty($doctoActaNotarial)) {
            flash()->error('Docto Acta Notarial no encontrado');

            return redirect(route('doctoActaNotarials.index'));
        }

        return view('docto_acta_notarials.show')->with('doctoActaNotarial', $doctoActaNotarial);
    }

    /**
     * Show the form for editing the specified DoctoActaNotarial.
     */
    public function edit($id)
    {
        /** @var DoctoActaNotarial $doctoActaNotarial */
        $doctoActaNotarial = DoctoActaNotarial::find($id);

        if (empty($doctoActaNotarial)) {
            flash()->error('Docto Acta Notarial no encontrado');

            return redirect(route('doctoActaNotarials.index'));
        }

        return view('docto_acta_notarials.edit')->with('doctoActaNotarial', $doctoActaNotarial);
    }

    /**
     * Update the specified DoctoActaNotarial in storage.
     */
    public function update($id, UpdateDoctoActaNotarialRequest $request)
    {
        /** @var DoctoActaNotarial $doctoActaNotarial */
        $doctoActaNotarial = DoctoActaNotarial::find($id);

        if (empty($doctoActaNotarial)) {
            flash()->error('Docto Acta Notarial no encontrado');

            return redirect(route('doctoActaNotarials.index'));
        }

        $doctoActaNotarial->fill($request->all());
        $doctoActaNotarial->save();

        flash()->success('Docto Acta Notarial actualizado.');

        return redirect(route('doctoActaNotarials.index'));
    }

    /**
     * Remove the specified DoctoActaNotarial from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var DoctoActaNotarial $doctoActaNotarial */
        $doctoActaNotarial = DoctoActaNotarial::find($id);

        if (empty($doctoActaNotarial)) {
            flash()->error('Docto Acta Notarial no encontrado');

            return redirect(route('doctoActaNotarials.index'));
        }

        $doctoActaNotarial->delete();

        flash()->success('Docto Acta Notarial eliminado.');

        return redirect(route('doctoActaNotarials.index'));
    }
}

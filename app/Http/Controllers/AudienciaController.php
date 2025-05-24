<?php

namespace App\Http\Controllers;

use App\DataTables\AudienciaDataTable;
use App\Http\Requests\CreateAudienciaRequest;
use App\Http\Requests\UpdateAudienciaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Audiencia;
use Illuminate\Http\Request;

class AudienciaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Audiencias')->only('show');
        $this->middleware('permission:Crear Audiencias')->only(['create','store']);
        $this->middleware('permission:Editar Audiencias')->only(['edit','update']);
        $this->middleware('permission:Eliminar Audiencias')->only('destroy');
    }
    /**
     * Display a listing of the Audiencia.
     */
    public function index(AudienciaDataTable $audienciaDataTable)
    {
    return $audienciaDataTable->render('audiencias.index');
    }


    /**
     * Show the form for creating a new Audiencia.
     */
    public function create()
    {
        return view('audiencias.create');
    }

    /**
     * Store a newly created Audiencia in storage.
     */
    public function store(CreateAudienciaRequest $request)
    {
        $input = $request->all();

        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::create($input);

        flash()->success('Audiencia guardado.');

        return redirect(route('audiencias.index'));
    }

    /**
     * Display the specified Audiencia.
     */
    public function show($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        return view('audiencias.show')->with('audiencia', $audiencia);
    }

    /**
     * Show the form for editing the specified Audiencia.
     */
    public function edit($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        return view('audiencias.edit')->with('audiencia', $audiencia);
    }

    /**
     * Update the specified Audiencia in storage.
     */
    public function update($id, UpdateAudienciaRequest $request)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        $audiencia->fill($request->all());
        $audiencia->save();

        flash()->success('Audiencia actualizado.');

        return redirect(route('audiencias.index'));
    }

    /**
     * Remove the specified Audiencia from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Audiencia $audiencia */
        $audiencia = Audiencia::find($id);

        if (empty($audiencia)) {
            flash()->error('Audiencia no encontrado');

            return redirect(route('audiencias.index'));
        }

        $audiencia->delete();

        flash()->success('Audiencia eliminado.');

        return redirect(route('audiencias.index'));
    }
}

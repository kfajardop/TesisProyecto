<?php

namespace App\Http\Controllers;

use App\DataTables\contactosDataTable;
use App\Http\Requests\CreatecontactosRequest;
use App\Http\Requests\UpdatecontactosRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\contactos;
use Illuminate\Http\Request;

class contactosController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Contactos')->only('show');
        $this->middleware('permission:Crear Contactos')->only(['create','store']);
        $this->middleware('permission:Editar Contactos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Contactos')->only('destroy');
    }
    /**
     * Display a listing of the contactos.
     */
    public function index(contactosDataTable $contactosDataTable)
    {
    return $contactosDataTable->render('contactos.index');
    }


    /**
     * Show the form for creating a new contactos.
     */
    public function create()
    {
        return view('contactos.create');
    }

    /**
     * Store a newly created contactos in storage.
     */
    public function store(CreatecontactosRequest $request)
    {
        $input = $request->all();

        /** @var contactos $contactos */
        $contactos = contactos::create($input);

        flash()->success('Contactos guardado.');

        return redirect(route('contactos.index'));
    }

    /**
     * Display the specified contactos.
     */
    public function show($id)
    {
        /** @var contactos $contactos */
        $contactos = contactos::find($id);

        if (empty($contactos)) {
            flash()->error('Contactos no encontrado');

            return redirect(route('contactos.index'));
        }

        return view('contactos.show')->with('contactos', $contactos);
    }

    /**
     * Show the form for editing the specified contactos.
     */
    public function edit($id)
    {
        /** @var contactos $contactos */
        $contactos = contactos::find($id);

        if (empty($contactos)) {
            flash()->error('Contactos no encontrado');

            return redirect(route('contactos.index'));
        }

        return view('contactos.edit')->with('contactos', $contactos);
    }

    /**
     * Update the specified contactos in storage.
     */
    public function update($id, UpdatecontactosRequest $request)
    {
        /** @var contactos $contactos */
        $contactos = contactos::find($id);

        if (empty($contactos)) {
            flash()->error('Contactos no encontrado');

            return redirect(route('contactos.index'));
        }

        $contactos->fill($request->all());
        $contactos->save();

        flash()->success('Contactos actualizado.');

        return redirect(route('contactos.index'));
    }

    /**
     * Remove the specified contactos from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var contactos $contactos */
        $contactos = contactos::find($id);

        if (empty($contactos)) {
            flash()->error('Contactos no encontrado');

            return redirect(route('contactos.index'));
        }

        $contactos->delete();

        flash()->success('Contactos eliminado.');

        return redirect(route('contactos.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\ContactoDataTable;
use App\Http\Requests\CreateContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Contactos')->only('show');
        $this->middleware('permission:Crear Contactos')->only(['create','store']);
        $this->middleware('permission:Editar Contactos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Contactos')->only('destroy');
    }
    /**
     * Display a listing of the Contacto.
     */
    public function index(ContactoDataTable $contactoDataTable)
    {
    return $contactoDataTable->render('contactos.index');
    }


    /**
     * Show the form for creating a new Contacto.
     */
    public function create()
    {
        return view('contactos.create');
    }

    /**
     * Store a newly created Contacto in storage.
     */
    public function store(CreateContactoRequest $request)
    {
        $input = $request->all();

        /** @var Contacto $contacto */
        $contacto = Contacto::create($input);

        flash()->success('Contacto guardado.');

        return redirect(route('contactos.index'));
    }

    /**
     * Display the specified Contacto.
     */
    public function show($id)
    {
        /** @var Contacto $contacto */
        $contacto = Contacto::find($id);

        if (empty($contacto)) {
            flash()->error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        return view('contactos.show')->with('contacto', $contacto);
    }

    /**
     * Show the form for editing the specified Contacto.
     */
    public function edit($id)
    {
        /** @var Contacto $contacto */
        $contacto = Contacto::find($id);

        if (empty($contacto)) {
            flash()->error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        return view('contactos.edit')->with('contacto', $contacto);
    }

    /**
     * Update the specified Contacto in storage.
     */
    public function update($id, UpdateContactoRequest $request)
    {
        /** @var Contacto $contacto */
        $contacto = Contacto::find($id);

        if (empty($contacto)) {
            flash()->error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        $contacto->fill($request->all());
        $contacto->save();

        flash()->success('Contacto actualizado.');

        return redirect(route('contactos.index'));
    }

    /**
     * Remove the specified Contacto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Contacto $contacto */
        $contacto = Contacto::find($id);

        if (empty($contacto)) {
            flash()->error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        $contacto->delete();

        flash()->success('Contacto eliminado.');

        return redirect(route('contactos.index'));
    }
}

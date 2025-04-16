<?php

namespace App\Http\Controllers;

use App\DataTables\PersonaDataTable;
use App\Http\Requests\CreatePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Personas')->only('show');
        $this->middleware('permission:Crear Personas')->only(['create','store']);
        $this->middleware('permission:Editar Personas')->only(['edit','update']);
        $this->middleware('permission:Eliminar Personas')->only('destroy');
    }
    /**
     * Display a listing of the Persona.
     */
    public function index(PersonaDataTable $personaDataTable)
    {
    return $personaDataTable->render('personas.index');
    }


    /**
     * Show the form for creating a new Persona.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created Persona in storage.
     */
    public function store(CreatePersonaRequest $request)
    {
        $input = $request->all();

        /** @var Persona $persona */
        $persona = Persona::create($input);

        flash()->success('Persona guardado.');

        return redirect(route('personas.index'));
    }

    /**
     * Display the specified Persona.
     */
    public function show($id)
    {
        /** @var Persona $persona */
        $persona = Persona::find($id);

        if (empty($persona)) {
            flash()->error('Persona no encontrado');

            return redirect(route('personas.index'));
        }

        return view('personas.show')->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified Persona.
     */
    public function edit($id)
    {
        /** @var Persona $persona */
        $persona = Persona::find($id);

        if (empty($persona)) {
            flash()->error('Persona no encontrado');

            return redirect(route('personas.index'));
        }

        return view('personas.edit')->with('persona', $persona);
    }

    /**
     * Update the specified Persona in storage.
     */
    public function update($id, UpdatePersonaRequest $request)
    {
        /** @var Persona $persona */
        $persona = Persona::find($id);

        if (empty($persona)) {
            flash()->error('Persona no encontrado');

            return redirect(route('personas.index'));
        }

        $persona->fill($request->all());
        $persona->save();

        flash()->success('Persona actualizado.');

        return redirect(route('personas.index'));
    }

    /**
     * Remove the specified Persona from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Persona $persona */
        $persona = Persona::find($id);

        if (empty($persona)) {
            flash()->error('Persona no encontrado');

            return redirect(route('personas.index'));
        }

        $persona->delete();

        flash()->success('Persona eliminado.');

        return redirect(route('personas.index'));
    }
}

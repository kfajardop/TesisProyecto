<?php

namespace App\Http\Controllers;

use App\DataTables\Caso_Penal_DelitoDataTable;
use App\Http\Requests\CreateCaso_Penal_DelitoRequest;
use App\Http\Requests\UpdateCaso_Penal_DelitoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Caso_Penal_Delito;
use Illuminate\Http\Request;

class Caso_Penal_DelitoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso  Penal  Delitos')->only('show');
        $this->middleware('permission:Crear Caso  Penal  Delitos')->only(['create','store']);
        $this->middleware('permission:Editar Caso  Penal  Delitos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso  Penal  Delitos')->only('destroy');
    }
    /**
     * Display a listing of the Caso_Penal_Delito.
     */
    public function index(Caso_Penal_DelitoDataTable $casoPenalDelitoDataTable)
    {
    return $casoPenalDelitoDataTable->render('caso__penal__delitos.index');
    }


    /**
     * Show the form for creating a new Caso_Penal_Delito.
     */
    public function create()
    {
        return view('caso__penal__delitos.create');
    }

    /**
     * Store a newly created Caso_Penal_Delito in storage.
     */
    public function store(CreateCaso_Penal_DelitoRequest $request)
    {
        $input = $request->all();

        /** @var Caso_Penal_Delito $casoPenalDelito */
        $casoPenalDelito = Caso_Penal_Delito::create($input);

        flash()->success('Caso  Penal  Delito guardado.');

        return redirect(route('casoPenalDelitos.index'));
    }

    /**
     * Display the specified Caso_Penal_Delito.
     */
    public function show($id)
    {
        /** @var Caso_Penal_Delito $casoPenalDelito */
        $casoPenalDelito = Caso_Penal_Delito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso  Penal  Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        return view('caso__penal__delitos.show')->with('casoPenalDelito', $casoPenalDelito);
    }

    /**
     * Show the form for editing the specified Caso_Penal_Delito.
     */
    public function edit($id)
    {
        /** @var Caso_Penal_Delito $casoPenalDelito */
        $casoPenalDelito = Caso_Penal_Delito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso  Penal  Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        return view('caso__penal__delitos.edit')->with('casoPenalDelito', $casoPenalDelito);
    }

    /**
     * Update the specified Caso_Penal_Delito in storage.
     */
    public function update($id, UpdateCaso_Penal_DelitoRequest $request)
    {
        /** @var Caso_Penal_Delito $casoPenalDelito */
        $casoPenalDelito = Caso_Penal_Delito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso  Penal  Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        $casoPenalDelito->fill($request->all());
        $casoPenalDelito->save();

        flash()->success('Caso  Penal  Delito actualizado.');

        return redirect(route('casoPenalDelitos.index'));
    }

    /**
     * Remove the specified Caso_Penal_Delito from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Caso_Penal_Delito $casoPenalDelito */
        $casoPenalDelito = Caso_Penal_Delito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso  Penal  Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        $casoPenalDelito->delete();

        flash()->success('Caso  Penal  Delito eliminado.');

        return redirect(route('casoPenalDelitos.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\CasoPenalDelitoDataTable;
use App\Http\Requests\CreateCasoPenalDelitoRequest;
use App\Http\Requests\UpdateCasoPenalDelitoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\CasoPenalDelito;
use Illuminate\Http\Request;

class CasoPenalDelitoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Caso Penal Delitos')->only('show');
        $this->middleware('permission:Crear Caso Penal Delitos')->only(['create','store']);
        $this->middleware('permission:Editar Caso Penal Delitos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Caso Penal Delitos')->only('destroy');
    }
    /**
     * Display a listing of the CasoPenalDelito.
     */
    public function index(CasoPenalDelitoDataTable $casoPenalDelitoDataTable)
    {
    return $casoPenalDelitoDataTable->render('caso_penal_delitos.index');
    }


    /**
     * Show the form for creating a new CasoPenalDelito.
     */
    public function create()
    {
        return view('caso_penal_delitos.create');
    }

    /**
     * Store a newly created CasoPenalDelito in storage.
     */
    public function store(CreateCasoPenalDelitoRequest $request)
    {
        $input = $request->all();

        /** @var CasoPenalDelito $casoPenalDelito */
        $casoPenalDelito = CasoPenalDelito::create($input);

        flash()->success('Caso Penal Delito guardado.');

        return redirect(route('casoPenalDelitos.index'));
    }

    /**
     * Display the specified CasoPenalDelito.
     */
    public function show($id)
    {
        /** @var CasoPenalDelito $casoPenalDelito */
        $casoPenalDelito = CasoPenalDelito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso Penal Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        return view('caso_penal_delitos.show')->with('casoPenalDelito', $casoPenalDelito);
    }

    /**
     * Show the form for editing the specified CasoPenalDelito.
     */
    public function edit($id)
    {
        /** @var CasoPenalDelito $casoPenalDelito */
        $casoPenalDelito = CasoPenalDelito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso Penal Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        return view('caso_penal_delitos.edit')->with('casoPenalDelito', $casoPenalDelito);
    }

    /**
     * Update the specified CasoPenalDelito in storage.
     */
    public function update($id, UpdateCasoPenalDelitoRequest $request)
    {
        /** @var CasoPenalDelito $casoPenalDelito */
        $casoPenalDelito = CasoPenalDelito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso Penal Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        $casoPenalDelito->fill($request->all());
        $casoPenalDelito->save();

        flash()->success('Caso Penal Delito actualizado.');

        return redirect(route('casoPenalDelitos.index'));
    }

    /**
     * Remove the specified CasoPenalDelito from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CasoPenalDelito $casoPenalDelito */
        $casoPenalDelito = CasoPenalDelito::find($id);

        if (empty($casoPenalDelito)) {
            flash()->error('Caso Penal Delito no encontrado');

            return redirect(route('casoPenalDelitos.index'));
        }

        $casoPenalDelito->delete();

        flash()->success('Caso Penal Delito eliminado.');

        return redirect(route('casoPenalDelitos.index'));
    }
}

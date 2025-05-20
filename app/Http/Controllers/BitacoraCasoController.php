<?php

namespace App\Http\Controllers;

use App\DataTables\BitacoraCasoDataTable;
use App\Http\Requests\CreateBitacoraCasoRequest;
use App\Http\Requests\UpdateBitacoraCasoRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\BitacoraCaso;
use Illuminate\Http\Request;

class BitacoraCasoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Bitacora Casos')->only('show');
        $this->middleware('permission:Crear Bitacora Casos')->only(['create','store']);
        $this->middleware('permission:Editar Bitacora Casos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Bitacora Casos')->only('destroy');
    }
    /**
     * Display a listing of the BitacoraCaso.
     */
    public function index(BitacoraCasoDataTable $bitacoraCasoDataTable)
    {
    return $bitacoraCasoDataTable->render('bitacora_casos.index');
    }


    /**
     * Show the form for creating a new BitacoraCaso.
     */
    public function create()
    {
        return view('bitacora_casos.create');
    }

    /**
     * Store a newly created BitacoraCaso in storage.
     */
    public function store(CreateBitacoraCasoRequest $request)
    {
        $input = $request->all();

        /** @var BitacoraCaso $bitacoraCaso */
        $bitacoraCaso = BitacoraCaso::create($input);

        flash()->success('Bitacora Caso guardado.');

        return redirect(route('bitacoraCasos.index'));
    }

    /**
     * Display the specified BitacoraCaso.
     */
    public function show($id)
    {
        /** @var BitacoraCaso $bitacoraCaso */
        $bitacoraCaso = BitacoraCaso::find($id);

        if (empty($bitacoraCaso)) {
            flash()->error('Bitacora Caso no encontrado');

            return redirect(route('bitacoraCasos.index'));
        }

        return view('bitacora_casos.show')->with('bitacoraCaso', $bitacoraCaso);
    }

    /**
     * Show the form for editing the specified BitacoraCaso.
     */
    public function edit($id)
    {
        /** @var BitacoraCaso $bitacoraCaso */
        $bitacoraCaso = BitacoraCaso::find($id);

        if (empty($bitacoraCaso)) {
            flash()->error('Bitacora Caso no encontrado');

            return redirect(route('bitacoraCasos.index'));
        }

        return view('bitacora_casos.edit')->with('bitacoraCaso', $bitacoraCaso);
    }

    /**
     * Update the specified BitacoraCaso in storage.
     */
    public function update($id, UpdateBitacoraCasoRequest $request)
    {
        /** @var BitacoraCaso $bitacoraCaso */
        $bitacoraCaso = BitacoraCaso::find($id);

        if (empty($bitacoraCaso)) {
            flash()->error('Bitacora Caso no encontrado');

            return redirect(route('bitacoraCasos.index'));
        }

        $bitacoraCaso->fill($request->all());
        $bitacoraCaso->save();

        flash()->success('Bitacora Caso actualizado.');

        return redirect(route('bitacoraCasos.index'));
    }

    /**
     * Remove the specified BitacoraCaso from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var BitacoraCaso $bitacoraCaso */
        $bitacoraCaso = BitacoraCaso::find($id);

        if (empty($bitacoraCaso)) {
            flash()->error('Bitacora Caso no encontrado');

            return redirect(route('bitacoraCasos.index'));
        }

        $bitacoraCaso->delete();

        flash()->success('Bitacora Caso eliminado.');

        return redirect(route('bitacoraCasos.index'));
    }
}

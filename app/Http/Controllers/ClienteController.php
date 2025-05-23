<?php

namespace App\Http\Controllers;

use App\DataTables\ClienteDataTable;
use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;

class ClienteController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Clientes')->only('show');
        $this->middleware('permission:Crear Clientes')->only(['create','store']);
        $this->middleware('permission:Editar Clientes')->only(['edit','update']);
        $this->middleware('permission:Eliminar Clientes')->only('destroy');
    }
    /**
     * Display a listing of the Cliente.
     */
    public function index(ClienteDataTable $clienteDataTable)
    {
    return $clienteDataTable->render('clientes.index');
    }

    /**
     * Show the form for creating a new Cliente.
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('clientes.create', compact('cliente'));
    }

    /**
     * Store a newly created Cliente in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $direccion = Direccion::create([
            'direccion' => $input['direccion'],
            'municipio_id' => $input['municipio_id'],
        ]);

        $input['direccion_id'] = $direccion->id;

        /** @var Cliente $cliente */
        $cliente = Cliente::create($input);

        flash()->success('Cliente guardado.');

        return redirect(route('clientes.index'));
    }

    /**
     * Display the specified Cliente.
     */
    public function show($id)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            flash()->error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        return view('clientes.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified Cliente.
     */
    public function edit($id)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            flash()->error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        return view('clientes.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified Cliente in storage.
     */
    public function update($id, Request $request)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            flash()->error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        $direccion = Direccion::find($cliente->direccion_id);

        if (empty($direccion)) {
            flash()->error('Direccion no encontrada');

            return redirect(route('clientes.index'));
        }

        $direccion->update([
            'direccion' => $request->input('direccion'),
            'municipio_id' => $request->input('municipio_id'),
        ]);

        $cliente->fill($request->all());
        $cliente->save();

        flash()->success('Cliente actualizado.');

        return redirect(route('clientes.index'));
    }

    /**
     * Remove the specified Cliente from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            flash()->error('Cliente no encontrado');

            return redirect(route('clientes.index'));
        }

        $cliente->delete();

        flash()->success('Cliente eliminado.');

        return redirect(route('clientes.index'));
    }
}

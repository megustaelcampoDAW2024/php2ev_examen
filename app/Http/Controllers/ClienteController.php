<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\Pais;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * ClienteController constructor.
     */
    public function __construct()
    {
        $this->middleware('rol:A')->only('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::getClientes();
        return view('cliente.index',
            ['clientes' => $clientes]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::getPaises();
        return view('cliente.create', [
            'paises' => $paises
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = new Cliente($request->validated());
        $cliente->save();
        return to_route('cliente.show', ['cliente' => $cliente->id])->with('success', 'Cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $paises = Pais::getPaises();
        return view('cliente.edit', [
            'cliente' => $cliente,
            'paises' => $paises
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClienteRequest $request, Cliente $cliente)
    {
        $cliente->fill($request->validated());
        $cliente->save();
        return to_route('cliente.show', ['cliente' => $cliente->id])->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return to_route('cliente.index')->with('success', 'Cliente eliminado correctamente');
    }
}

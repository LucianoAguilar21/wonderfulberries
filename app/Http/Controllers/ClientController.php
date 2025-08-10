<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::whereNull('deleted_at')->get();
        return view('clients.index')->with(['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:clients,name'
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Cliente creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
         return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
         $request->validate([
        'name' => 'required|string|max:255|unique:clients,name,' . $client->id,
        ]);

        $client->update($request->only('name'));

        return redirect()->route('admin.clients.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
       $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Cliente eliminado correctamente.');
    }
}

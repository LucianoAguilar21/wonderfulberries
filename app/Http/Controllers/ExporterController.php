<?php

namespace App\Http\Controllers;

use App\Models\Exporter;
use Illuminate\Http\Request;

class ExporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exporters.index')->with(['exporters' => Exporter::whereNull('deleted_at')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exporters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exporters,name'
        ]);

        Exporter::create($validated);
        return redirect()->route('admin.exporters.index')->with('success', 'Exportador creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exporter $exporter)
    {
        return view('exporters.show', compact('exporter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exporter $exporter)
    {
        return view('exporters.edit', compact('exporter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exporter $exporter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:exporters,name,' . $exporter->id
        ]);

        $exporter->update($validated);
        return redirect()->route('admin.exporters.index')->with('success', 'Exportador actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exporter $exporter)
    {
        $exporter->delete();
        return redirect()->route('admin.exporters.index')->with('success', 'Exportador eliminado con éxito');
    }
}

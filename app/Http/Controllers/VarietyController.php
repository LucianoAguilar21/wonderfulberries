<?php

namespace App\Http\Controllers;

use App\Models\Variety;
use Illuminate\Http\Request;

class VarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('varieties.index')->with(['varieties'=>Variety::whereNull('deleted_at')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('varieties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:varieties,name'
        ]);

        Variety::create($validated);
        return redirect()->route('admin.varieties.index')->with('success', 'Variedad creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variety $variety)
    {
        return view('varieties.show',compact('variety'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variety $variety)
    {
        return view('varieties.edit',compact('variety'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variety $variety)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:varieties,name,'.$variety->id
        ]);

        $variety->update($validated);
        return redirect()->route('admin.varieties.index')->with('success', 'Variedad actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variety $variety)
    {
        $variety->delete();

        return redirect()->route('admin.varieties.index')->with('success', 'Variedad eliminada con éxito');
    }
}

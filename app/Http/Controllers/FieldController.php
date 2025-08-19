<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fields.index')->with(['fields' => Field::whereNull('deleted_at')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_number' => 'required|integer|unique:fields,field_number',
            'name' => 'required|string|max:255|unique:fields,name',
        ]);



        Field::create($request->all());
        return redirect()->route('admin.fields.index')->with('success', 'Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        return view('fields.show')->with('field', $field);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        return view('fields.edit')->with('field', $field);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $field)
    {
        $validated = $request->validate([
            'field_number' => 'required|integer|unique:fields,field_number,' . $field->id,
            'name' => 'required|string|max:255|unique:fields,name,' . $field->id
        ]);

        $field->update($validated);
        return redirect()->route('admin.fields.index')->with('success', 'Field updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Field deleted successfully.');
    }
}

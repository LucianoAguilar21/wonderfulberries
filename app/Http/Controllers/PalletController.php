<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Pallet;
use App\Models\Variety;
use Illuminate\Http\Request;

class PalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
            $validated = $request->validate([
                'pallet_number' => 'required|string|max:255',


                'varieties' => 'required|array|min:1',
                'varieties.*.field_id' => 'required|exists:fields,id',
                'varieties.*.lots' => 'required|string',
                'varieties.*.variety_id' => 'required|exists:varieties,id',
                'varieties.*.numberOfBoxes' => 'required|integer|min:1',

                'reds' => 'required|numeric|min:0|max:100',
                'deshidrated' => 'required|numeric|min:0|max:100',
                'sensitivas' => 'required|numeric|min:0|max:100',
                'soft' => 'required|numeric|min:0|max:100',
                'wounds' => 'required|numeric|min:0|max:100',
                'scars' => 'required|numeric|min:0|max:100',
                'rotten' => 'required|numeric|min:0|max:100',
                'fungus' => 'required|numeric|min:0|max:100',
                'score' => 'required|in:A,B,C,D',
                'qc' => 'required|numeric|min:0|max:100',
                'traceability' => 'required|string|max:1000',
                'observations' => 'nullable|string|max:1000',
            ]);

            // Crear el pallet
            $pallet = Pallet::create([
                'order_id' => $request->input('order_id'), //  order_id en la solicitud
                'pallet_number' => $validated['pallet_number'],
                'score' => $validated['score'],
                'traceability' => $validated['traceability'],
                'reds' => $validated['reds'],
                'deshidrated' => $validated['deshidrated'],
                'sensitivas' => $validated['sensitivas'],
                'soft' => $validated['soft'],
                'wounds' => $validated['wounds'],
                'scars' => $validated['scars'],
                'rotten' => $validated['rotten'],
                'fungus' => $validated['fungus'],
                'QC' => $validated['qc'],
                'observations' => $validated['observations'] ?? null,

            ]);

            // agregar las variedades
            if ($request->has('varieties')) {
                foreach ($validated['varieties'] as $variety) {
                    $pallet->palletInfos()->create([
                        'field_id' => $variety['field_id'],
                        'lots' => $variety['lots'],
                        'variety_id' => $variety['variety_id'],
                        'number_of_boxes' => $variety['numberOfBoxes'],
                    ]);
                }
            }

            return redirect()->route('orders.show',$request->input('order_id'))->with('success', 'Pallet creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pallet $pallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pallet $pallet)
    {
        $varieties = Variety::all()->whereNull('deleted_at');
        $fields = Field::all();
        return view('pallets.edit')->with(['pallet'=>$pallet, 'varieties'=>$varieties,'fields'=>$fields]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pallet $pallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pallet $pallet)
    {

        $pallet->palletInfos()->delete(); // Elimina las variedades asociadas
        $pallet->delete(); // Elimina el pallet

        return redirect()->route('orders.show', $pallet->order_id)->with('deleted', 'Pallet eliminado con éxito.');
    }
}

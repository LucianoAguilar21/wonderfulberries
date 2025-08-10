<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Exporter;
use App\Models\Field;
use App\Models\Variety;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('can:create', [
            'only' => ['create','edit','delete','update']
        ]);
        $this->middleware('can:view',[
            'only'=> ['index','show','copyInfo','copyInfo']
        ]);

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('viewAny',Order::class);
        // Gate::authorize('view-orders');
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::whereNull('deleted_at')->get();
        $destinations = Destination::all(); //
        $exporters = Exporter::all(); //
        return view('orders.create',
            compact([
                'clients' ,
                'destinations',
                'exporters'
            ])
        ); // Return the view for creating an order
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'destination_id' => 'required|exists:destinations,id',
            'exporter_id' => 'required|exists:exporters,id',
            'transport' => 'required|in:air,sea,land',
            'status' => 'required|in:open,closed',
            'organic' => 'boolean',
            'observations' => 'nullable|string',
            'pot_size' => 'required|string|max:255',
            'total_pallets' => 'integer|min:0',
            'is_labeled' => 'boolean',
            'label' => 'nullable|string|max:255',
            'treatment' => 'required|in:Frio,Brom',
            'box_type' => 'required|string|max:255',
            'total_pallets' => 'integer|min:0',
            'end_date' => 'nullable|date',
        ]);

        $order = new Order($validated);
        $order->status = 'open'; // Default status

        $order->save();
        if($order)
        {
            return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        }
        return redirect()->route('orders.index')->with('error', 'Failed to create order. Please try again.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
     // Fetch the order by ID
        // Gate::authorize('viewAny',Order::class);
        return view('orders.show')->with(['order'=>$order, 'fields'=> Field::all(), 'varieties'=> Variety::all()->whereNull('deleted_at'),  'pallets' => $order->pallets]); // Return the view for showing an order
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {


        $clients = Client::all();
        $destinations = Destination::all();
        $exporters = Exporter::all();

        return view('orders.edit')->with(['order'=>$order,'clients'=>$clients, 'destinations'=>$destinations, 'exporters'=>$exporters]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'destination_id' => 'required|exists:destinations,id',
        'exporter_id' => 'required|exists:exporters,id',
        'transport' => 'required|in:air,sea,land',
        'observations' => 'nullable|string',
        'pot_size' => 'required|string|max:10',
        'organic' => 'nullable|boolean',
        'is_labeled' => 'nullable|boolean',
        'label' => 'nullable|string|max:255',
        'box_type' => 'required|string|max:100',
        'treatment' => 'required|in:Frio,Brom',
        'status' => 'required|in:open,closed',
    ]);

    $order->update([
        'client_id' => $validated['client_id'],
        'destination_id' => $validated['destination_id'],
        'exporter_id' => $validated['exporter_id'],
        'transport' => $validated['transport'],
        'observations' => $validated['observations'] ?? null,
        'pot_size' => $validated['pot_size'],
        'organic' => $request->has('organic'),
        'is_labeled' => $request->has('is_labeled'),
        'label' => $request->input('label') ?? null,
        'box_type' => $validated['box_type'],
        'treatment' => $validated['treatment'],
        'status' => $validated['status'],
    ]);

    return redirect()->route('orders.index')
        ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

//     public function copyInfo(Order $order)
// {
//     $order->load(['client', 'exporter', 'pallets.palletInfos.variety', 'pallets.palletInfos.field']);

//     $text = "Proceso Wonderful " . now()->format('d/m/y') . "\n";
//     $text .= "Exportación\n";
//     $text .= "Cliente: " . $order->client->name . "\n\n";

//     $palletsCount = $order->pallets->count();
//     $totalBoxes = $order->pallets->flatMap(function ($pallet) {
//         return $pallet->palletInfos;
//     })->sum('number_of_boxes');

//     $text .= "{$palletsCount}P x {$totalBoxes} Cjs  x 12 x 6oz- ";
//     $text .= "Et: {$order->label} - cjs WB - Exp. {$order->exporter->name} - ";
//     $text .= "Brom- Usa- " . ucfirst($order->transport) . "\n\n";

//     foreach ($order->pallets as $index => $pallet) {
//         $text .= ($index + 1) . "°P" . str_pad($pallet->pallet_number, 4, "0", STR_PAD_LEFT) . "= ";

//         $varieties = [];
//         foreach ($pallet->palletInfos as $info) {
//             $field = $info->field->name ?? '';
//             $variety = $info->variety->name ?? '';
//             $lots = $info->lots;
//             $boxes = $info->number_of_boxes;
//             $varieties[] = "{$field} ({$lots}) {$variety} ({$boxes} Cjs)";
//         }
//         $text .= implode('| ', $varieties) . "\n";

//         $text .= "Traza en caja: " . ($pallet->traceability ?? '-') . "\n";
//         $text .= "QC.:{$pallet->QC}%\n";
//         $text .= "Def: Rj.:{$pallet->reds} %|Sens.:{$pallet->sensitivas}%|Bl.:{$pallet->soft}%\n\n";
//     }

//     return response($text);
// }

    public function copyInfo(Order $order)
    {
        $order->load(['client', 'exporter', 'pallets.palletInfos.variety', 'pallets.palletInfos.field']);

        $text = "Proceso Wonderful " . now()->format('d/m/y') . "\n";
        $text .= "Exportación\n";
        $text .= "Cliente: " . $order->client->name . "\n\n";

        $palletsCount = $order->pallets->count();
        $totalBoxes = $order->pallets->flatMap(function ($pallet) {
            return $pallet->palletInfos;
        })->sum('number_of_boxes');

        $text .= "{$palletsCount}P x {$totalBoxes} Cjs  x 6oz- ";
        $text .= "Et: {$order->label} - cjs WB - Exp. {$order->exporter->name} - ";
        $text .= "Brom- Usa- " . ucfirst($order->transport) . "\n\n";

        foreach ($order->pallets as $index => $pallet) {
            $text .= ($index + 1) . "°P" . str_pad($pallet->pallet_number, 4, "0", STR_PAD_LEFT) . "= ";

            $varieties = [];
            foreach ($pallet->palletInfos as $info) {
                $field = $info->field->name ?? '';
                $variety = $info->variety->name ?? '';
                $lots = $info->lots;
                $boxes = $info->number_of_boxes;
                $varieties[] = "{$field} ({$lots}) {$variety} ({$boxes} Cjs)";
            }
            $text .= implode('| ', $varieties) . "\n";

            $text .= "Traza en caja: " . ($pallet->traceability ?? '-') . "\n";
            $text .= "QC.:{$pallet->QC}%\n";
            $text .= "Def: Rj.:{$pallet->reds} %|Sens.:{$pallet->sensitivas}%|Bl.:{$pallet->soft}%\n\n";
        }

        return view('orders.copy-info', compact('text'));
    }


}

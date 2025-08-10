<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Client;
use App\Models\Destination;
use App\Models\Exporter;
use App\Models\Pallet;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'destination_id',
        'exporter_id',
        'transport',
        'status',
        'organic',
        'observations',
        'pot_size',
        'total_pallets',
        'is_labeled',
        'label',
        'treatment',
        'box_type',
        'end_date'
    ];

    function client() : BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    function destination() : BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    function pallets() : HasMany
    {
        return $this->hasMany(Pallet::class);
    }

    function exporter() : BelongsTo
    {
        return $this->belongsTo(Exporter::class);
    }
}

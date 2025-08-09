<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pallet extends Model
{
    /** @use HasFactory<\Database\Factories\PalletFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'pallet_number',   
        'score',
        'traceability',
        'reds',
        'deshidrated',
        'sensitivas',
        'soft',
        'wounds',
        'scars',
        'rotten',
        'fungus',
        'QC',
        'observations',
        'created_at',
        'updated_at',
    ];



    function palletInfos() : HasMany
    {
        return $this->hasMany(PalletInfo::class);
    }

    function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }


}

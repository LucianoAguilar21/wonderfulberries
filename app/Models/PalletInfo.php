<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalletInfo extends Model
{
    /** @use HasFactory<\Database\Factories\PalletInfoFactory> */
    use HasFactory;

    protected $fillable = [
    'field_id',
    'lots',
    'variety_id',
    'number_of_boxes',
];

    public function pallet()
    {
        return $this->belongsTo(Pallet::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class)->withTrashed();
    }

    public function variety()
    {
        return $this->belongsTo(Variety::class)->withTrashed();
    }
}

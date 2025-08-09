<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exporter extends Model
{
    /** @use HasFactory<\Database\Factories\ExporterFactory> */
    use HasFactory;

    protected $fillable = [
        'name',

    ];


    function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App\Models;

use Database\Factories\OilChangeCheckFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
    /** @use HasFactory<OilChangeCheckFactory> */
    use HasFactory;

    protected $fillable = [
        'current_odometer',
        'previous_oil_change_date',
        'previous_oil_change_odometer',
        'is_due',
    ];

    protected $casts = [
        'current_odometer' => 'integer',
        'previous_oil_change_date' => 'date',
        'previous_oil_change_odometer' => 'integer',
        'is_due' => 'boolean',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilChangeCheck extends Model
{
    protected $fillable = [
        "current_odometer",
        "previous_oil_change_date",
        "previous_oil_change_odometer",
        "is_due",
    ];

    protected $casts = [
        "previous_oil_change_date" => "date",
        "is_due" => "boolean",
    ];
}

<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_plate',
        'chassis_number',
        'engine_number',
        'manufacturer_id',
        'color_id',
        'type_id',
        'insurance_id'
    ];
}

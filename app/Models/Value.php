<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = ['name','attribute_id'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class,'car_value','value_id');
    }
}

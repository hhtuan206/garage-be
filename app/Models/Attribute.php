<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function values()
    {
        return $this->hasMany(Value::class,'attribute_id');
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class,'car_attribute','attribute_id');
    }
}

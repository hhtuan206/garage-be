<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_plate',
        'engine_number',
        'user_id'
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'car_attribute', 'car_id');
    }

    public function values()
    {
        return $this->belongsToMany(Value::class, 'car_value', 'car_id')->withPivot('attribute_id');
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

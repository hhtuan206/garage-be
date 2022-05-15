<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'detail',
        'discount',
        'status',
    ];

    public function repairs()
    {
        return $this->belongsToMany(Repair::class,'repair_service','service_id');
    }

    public function getPricesAttribute()
    {
        return number_format($this->price,0);
    }
}

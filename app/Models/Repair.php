<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = ['is_appointment','user_id','car_id','total_price'];

    public function services()
    {
        return $this->belongsToMany(Service::class,'repair_service','repair_id');
    }

    public function components()
    {
        return $this->belongsToMany(Component::class,'repair_component','repair_id')
            ->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getTotalAttribute()
    {
        return number_format($this->total_price,0);
    }

    public function getDateRepairAttribute()
    {
        return date('d-m-Y',strtotime($this->created_at));
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($repair) {
            $repair->services()->detach();
            $repair->components()->detach();
        });
    }
}

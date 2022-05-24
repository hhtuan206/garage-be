<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'date',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateTimeAttribute()
    {
        return $this->date . " " . $this->time;
    }

    public function getDateCreateAttribute()
    {
        return date('d-m-Y',strtotime($this->created_at));
    }

    public function getStatussAttribute()
    {
        if ($this->status == 'Waiting') {
            return '<label for="" class="badge badge-primary">Đang chờ</label>';
        }
        return '<label for="" class="badge badge-info">Xác nhận</label>';
    }
}

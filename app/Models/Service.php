<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    const ACTIVE = 'Active';
    const DEACTIVATE = 'Deactive';

    protected $fillable = [
        'name',
        'price',
        'detail',
        'discount',
        'status',
    ];

    public function repairs()
    {
        return $this->belongsToMany(Repair::class, 'repair_service', 'service_id');
    }

    public function getPricesAttribute()
    {
        return number_format($this->price, 0);
    }

    public function getStatussAttribute()
    {
        if ($this->status == self::ACTIVE) {
            return '<label for="" class="badge badge-info">Hoạt động</label>';
        }
        return '<label for="" class="badge badge-primary">Không hoạt động</label>';

    }
}

<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public function component()
    {
        return $this->hasMany(Component::class, 'category_id');
    }

    public function getTypeVAttribute()
    {
        if ($this->type == 'news') {
            return '<label for="" class="badge badge-success">Tin tức</label>';
        }
        return '<label for="" class="badge badge-primary">Linh kiện</label>';

    }
}

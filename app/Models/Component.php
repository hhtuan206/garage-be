<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Vanguard\Http\Requests\Request;
use Vanguard\Presenters\Traits\UploadImageTrait;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'stock',
        'unit',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function repairs()
    {
        return $this->belongsToMany(Repair::class,'repair_component','component_id')->withPivot('quantity');
    }

    public function getPricesAttribute()
    {
        return number_format($this->price,0);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($component) {
            if ($component->image instanceof UploadedFile) {
                $component->image = UploadImageTrait::upload($component->image,'component');
            }
        });

        static::updating(function ($component) {
            if ($component->image instanceof UploadedFile) {
                $component->image = UploadImageTrait::upload($component->image,'component');
            }
        });

        static::deleting(function ($component) {
            File::delete('component/' . $component->image);
        });
    }
}

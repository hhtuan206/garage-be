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
        'discount',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($component) {
            $component->image = UploadImageTrait::upload($component->image);

        });

        static::updating(function ($component) {
            if ($component->image instanceof UploadedFile) {
                $component->image = UploadImageTrait::upload($component->image);
            }
        });

        static::deleting(function ($component) {
            File::delete('component/' . $component->image);
        });
    }
}

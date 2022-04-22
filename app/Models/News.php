<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Vanguard\Presenters\Traits\UploadImageTrait;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_cover',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if ($news->image_cover instanceof UploadedFile) {
                $news->image_cover = UploadImageTrait::upload($news->image_cover,'new');
            }
        });

        static::updating(function ($news) {
            if ($news->image_cover instanceof UploadedFile) {
                $news->image_cover = UploadImageTrait::upload($news->image_cover,'new');
            }
        });

        static::deleting(function ($news) {
            File::delete('new/' . $news->image_cover);
        });
    }
}

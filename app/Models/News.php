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
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if ($news->image instanceof UploadedFile) {
                $news->image = UploadImageTrait::upload($news->image_cover,'new');
            }
        });

        static::updating(function ($news) {
            if ($news->image instanceof UploadedFile) {
                $news->image = UploadImageTrait::upload($news->image_cover,'new');
            }
        });

        static::deleting(function ($news) {
            File::delete('new/' . $news->image);
        });
    }
}

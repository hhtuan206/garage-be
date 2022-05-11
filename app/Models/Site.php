<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Vanguard\Presenters\Traits\UploadImageTrait;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'content'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($site) {
            if ($site->content instanceof UploadedFile) {
                $site->content = UploadImageTrait::upload($site->content, 'upload');
            }
        });
    }
}

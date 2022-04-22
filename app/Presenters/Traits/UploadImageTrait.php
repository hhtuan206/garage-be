<?php


namespace Vanguard\Presenters\Traits;


use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use function PHPUnit\Framework\isEmpty;

trait UploadImageTrait
{
    public static function upload($image = '', $folder = '')
    {
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path($folder), $imageName);
        return $imageName;
    }

}

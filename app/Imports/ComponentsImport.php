<?php

namespace Vanguard\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Vanguard\Models\Component;

class ComponentsImport implements ToCollection, WithHeadingRow
{

    public $spreadsheet = null, $arr = [];

    public function __construct($component)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $this->spreadsheet = $reader->load($component);

    }


    public function before()
    {
        foreach ($this->spreadsheet->getActiveSheet()->getDrawingCollection() as $key => $drawing) {
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            } else {
                if ($drawing->getPath()) {
                    // Check if the source is a URL or a file path
                    if ($drawing->getIsURL()) {
                        $imageContents = file_get_contents($drawing->getPath());
                        $filePath = tempnam(sys_get_temp_dir(), 'Drawing');
                        file_put_contents($filePath, $imageContents);
                        $mimeType = mime_content_type($filePath);
                        // You could use the below to find the extension from mime type.
                        // https://gist.github.com/alexcorvi/df8faecb59e86bee93411f6a7967df2c#gistcomment-2722664
                        $extension = File::mime2ext($mimeType);
                        unlink($filePath);
                    } else {
                        $zipReader = fopen($drawing->getPath(), 'r');
                        $imageContents = '';
                        while (!feof($zipReader)) {
                            $imageContents .= fread($zipReader, 1024);
                        }
                        fclose($zipReader);
                        $extension = $drawing->getExtension();
                    }
                }
            }
            $myFileName = time() . $key . '.' . $extension;
            if (!File::exists('component')) {
                File::makeDirectory('component', 0777, true, true);
            }
            file_put_contents(public_path('component\\' . $myFileName), $imageContents);
            $this->arr[$key] = $myFileName;

        }
    }

    public function collection(Collection $collection)
    {
        $this->before();
        foreach ($collection as $key => $row) {
            Component::create([
                'name' => $row['name'],
                'price' => $row['price'],
                'stock' => $row['stock'],
                'discount' => $row['discount'],
                'description' => $row['description'],
                'image' => $this->arr[$key],
            ]);
        }
    }

}

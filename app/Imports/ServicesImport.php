<?php

namespace Vanguard\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Vanguard\Models\Service;

class ServicesImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Service::create([
                'name' => $row['name'],
                'price' => $row['price'],
                'discount' => $row['discount'],
                'detail' => $row['detail'],
                'status' => $row['status'],
            ]);
        }
    }
}

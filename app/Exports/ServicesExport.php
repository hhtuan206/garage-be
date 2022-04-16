<?php

namespace Vanguard\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Vanguard\Models\Service;

class ServicesExport implements WithHeadings
{

    public function headings(): array
    {
        return ['name','price','discount','detail','status'];
    }
}

<?php

namespace Vanguard\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Vanguard\Models\Component;

class ComponentsExport implements WithHeadings
{

    public function headings(): array
    {
        return ['name','price','stock','description','unit','category_id','image'];
    }
}

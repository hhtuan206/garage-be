<?php

namespace Vanguard\Exports;

use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepairExport implements FromCollection, WithHeadings, WithMapping
{
    protected $repair;

    public function __construct($repair)
    {
        $this->repair = $repair;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->repair;
    }

    public function headings(): array
    {
        return ['Mã sửa chữa', 'Xe', 'Tên khách hàng', 'Dịch vụ sử dụng', 'Tổng tiền', 'Sửa chữa ngày'];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->car->number_plate,
            $row->user->full_name,
            $row->services->map(function ($service) {
                return $service->name;
            }),
            number_format($row->total_price) . ' đ',
            date('H:m:s d-m-Y', strtotime($row->created_at)),
        ];
    }
}

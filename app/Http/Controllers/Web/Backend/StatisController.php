<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Exports\RepairExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Component;
use Vanguard\Models\Repair;

class StatisController extends Controller
{

    const EXPORT = 'export';
    const TYPE = 'excel';

    public function statisComponent(Request $request)
    {
        $query = Component::query();
        if ($request->has('stock') && $request->stock != '') {
            switch ($request->stock) {
                case 0:
                    break;
                case 1:
                    $query->where('stock', '>', 0);
                    break;
                case 2:
                    $query->where('stock', '=', 0);
                    break;
            }
        }
        if ($request->has('search') && $request->search != '') {
            $query->where('name', $request->search);
        }
        $components = $query->orderBy('id', 'desc')->get();
        return view('statis.component', compact('components'));

    }

    public function statisRepair(Request $request)
    {
        $query = Repair::query();

        if ($request->has('start_date') && $request->has('end_date') && $request->start_date != '' && $request->end_date != '') {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();;
            $end_date = Carbon::parse($request->input('end_date'))->startOfDay();
            $query->whereBetween('repairs.created_at', [$start_date, $end_date]);
        }
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('users.first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $request->search . '%');

            })->orWhereHas('car', function ($query) use ($request) {
                $query->where('cars.number_plate', 'like', '%' . $request->search . '%');
            });
        }
        $repairs = $query->orderBy('repairs.created_at', 'desc')->get();
        if ($request->has(self::EXPORT) && $request->export == self::TYPE) {
            return Excel::download(new RepairExport($repairs), 'Statis_Repair.xlsx');
        }
        return view('statis.repair', [
            'repairs' => $repairs
        ]);
    }
}

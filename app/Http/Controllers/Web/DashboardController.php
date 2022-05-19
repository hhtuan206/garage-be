<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Vanguard\Charts\AppointmentChart;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;

class DashboardController extends Controller
{
    /**
     * Displays the application dashboard.
     *
     * @return Factory|View
     */
    public function index()
    {
        if (session()->has('verified')) {
            session()->flash('success', __('E-Mail verified successfully.'));
        }
//        $appointmentChart = new AppointmentChart;
//        $appointmentChart->labels([
//            'Tháng 01',
//            'Tháng 02',
//            'Tháng 03',
//            'Tháng 04',
//            'Tháng 05',
//            'Tháng 06',
//            'Tháng 07',
//            'Tháng 08',
//            'Tháng 09',
//            'Tháng 10',
//            'Tháng 11',
//            'Tháng 12'
//        ]);
//        $data = Appointment::all()->sortByDesc('date')->groupBy(function ($d) {
//            return 'Tháng ' . date('m', strtotime($d->date));
//        })->map(function ($appointment) {
//            return count($appointment);
//        });
//        dd(Appointment::all());
//        $appointmentChart->dataset('Khách hàng đặt lịch', 'line', $data->values());
        return view('dashboard.index');
    }
}

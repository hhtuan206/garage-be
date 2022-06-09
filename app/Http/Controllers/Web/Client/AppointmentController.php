<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;
use Vanguard\Models\Service;
use Vanguard\Models\Site;

class AppointmentController extends Controller
{
    const WAITING = 'Waiting';
    const CONFIRM = 'Confirm';
    const CANCELLED = 'Cancelled';
    const SUCCESS = 'Success';

    public function index()
    {
        return view('customer.appointment.index');
    }

    public function store(Request $request)
    {
        $appointmentExist = Appointment::whereBetween('date', [Carbon::now()->subDay(1), date('Y-m-d', strtotime($request->time))])
            ->where('status', self::WAITING)->exists();
        if ($appointmentExist) {
            return redirect()->back()->withErrors('Bạn đã đặt lịch rồi, vui lòng đợi xác nhận từ hệ thống!!!!');
        }
        Appointment::create([
            'user_id' => \Auth::id(),
            'time' => date('H:i', strtotime($request->time)),
            'date' => date('Y-m-d', strtotime($request->time)),
            'status' => self::WAITING,
        ]);
        return redirect()->back()->withSuccess('Đặt lịch thành công ');
    }

    public function history()
    {
        $appointments = Appointment::where('user_id', \Auth::id())->orderBy('date', 'asc')->get();
        return view('customer.appointment.list', compact('appointments'));
    }
}

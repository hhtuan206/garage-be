<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;
use Vanguard\Models\Service;
use Vanguard\Models\Site;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('customer.appointment.index');
    }

    public function store(Request $request)
    {
//        Appointment::create([
//            ''
//        ]);
    }

    public function history()
    {
        $appointments = \Auth::user()->appointment->sortByDesc('created_at');
        return view('customer.appointment.list', compact('appointments'));
    }
}

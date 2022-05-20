<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;

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
        $appointments = \Auth::user()->appointment;
        return view('customer.appointment.list', compact('appointments'));
    }
}

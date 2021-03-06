<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Fluent;
use phpDocumentor\Reflection\Types\This;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;
use Vanguard\Role;
use Vanguard\User;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Appointment::query();
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('users.first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date != '' && $request->end_date != '') {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();;
            $end_date = Carbon::parse($request->input('end_date'))->startOfDay();
            $query->whereBetween('date', [$start_date, $end_date]);
        }
        $appointments = $query->orderBy('id', 'desc')->simplePaginate(12);
        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointment.add-edit', [
            'edit' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric'
        ], [
            'phone.numeric' => 'Số điện thoại không được chứa ký hiệu đặc biệt hoặc chữ cái',
            'phone.required' => 'Số điện thoại không được để trống',
        ]);
        try {
            $full_name = $this->parseName($request->full_name);
            $user = User::updateOrCreate(
                [
                    'phone' => $request->phone,
                ],
                [
                    'phone' => $request->phone,
                    'first_name' => $full_name->first_name,
                    'last_name' => $full_name->last_name,
                    'address' => $request->address ?? "",
                    'role_id' => Role::where('name', 'User')->first()->id,
                    'status' => 'Active',
                ]);
            Appointment::updateOrCreate([
                'user_id' => $user->id,
                'date' => date('Y-m-d', strtotime($request->time)),
                'status' => $request->status
            ], [
                'user_id' => $user->id,
                'time' => date('H:i', strtotime($request->time)),
                'date' => date('Y-m-d', strtotime($request->time)),
                'status' => $request->status,
            ]);
            return redirect()->route('appointments.index')
                ->withSuccess(__('Appointment created successfully.'));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('appointments.index')
                ->withErrors(__('Có lỗi xảy ra vui lòng thử lại sau.'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('appointment.add-edit', [
            'edit' => true,
            'appointment' => $appointment,
            'customer' => User::find($appointment->user_id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        try {
            Appointment::find($appointment->id)->update([
                'time' => date('H:i', strtotime($request->time)),
                'date' => date('Y-m-d', strtotime($request->time)),
                'status' => $request->status,
            ]);
            return redirect()->route('appointments.index')
                ->withSuccess(__('Appointment updated successfully.'));
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->route('appointments.index')
                ->withErrors(__('Có lỗi xảy ra vui lòng thử lại sau.'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        Appointment::destroy($appointment->id);
        return redirect()->route('appointments.index')
            ->withSuccess(__('Appointment deleted successfully.'));
    }

    public function parseName($name)
    {
        $split = explode(" ", $name);
        return new Fluent([
            'first_name' => array_shift($split),
            'last_name' => implode(" ", $split),
        ]);
    }
}

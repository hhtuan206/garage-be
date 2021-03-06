<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Appointment;
use Vanguard\Models\Attribute;
use Vanguard\Models\Car;
use Vanguard\Models\Component;
use Vanguard\Models\Repair;
use Vanguard\Models\Service;
use Vanguard\Role;
use Vanguard\User;
use DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Repair::query();
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('users.first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $request->search . '%');

            })->orWhereHas('car', function ($query) use ($request) {
                $query->where('cars.number_plate', 'like', '%' . $request->search . '%');
            });
        }
        $repairs = $query->orderBy('id', 'desc')->simplePaginate(12);
        return view('repair.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $attributes = Attribute::all()->pluck('name', 'id');
        $services = Service::all()->pluck('name', 'id');
        $components = Component::where('stock', '>', 0)->pluck('name', 'id');
        $users = User::all()->pluck('info', 'id');
        if (\request()->user_id != null) {
            $user = User::findOrFail(\request()->user_id);
        }
        $data = [
            'edit' => false,
            'attributes' => $attributes,
            'services' => $services,
            'components' => $components,
            'users' => $users,
            'appointment' => $request->appointment
        ];

        return view('repair.add-edit', $data);
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
            'car_id' => 'required',
            'services' => 'required',
        ], [
            'car_id.required' => 'Ph???i ch???n 1 xe',
            'services.required' => 'Ph???i ch???n 1 d???ch v???',
        ]);
        DB::beginTransaction();
        try {
            Appointment::findOrFail($request->appointment)->update(['status' => 'Success']);
            $total_price = null;
            $repair = Repair::create([
                'car_id' => $request->car_id,
                'user_id' => $request->user_id,
                'total_price' => 0,
            ]);

            if ($request->has('services')) {
                $total_price += (int)$this->calculateTotal($request->services, null, null);
                $repair->services()->sync($request->services);
            }
            if ($request->has('components')) {
                foreach ($request->components as $key => $component) {
                    $ct = Component::find($component);
                    $ct->stock = (int)$ct->stock - (int)$request->quantities[$key];
                    $ct->save();
                    $repair->components()->attach([$component => ['quantity' => $request->quantities[$key]]]);
                }
                $total_price += (int)$this->calculateTotal(null, $request->components, $request->quantities);
            }
            $repair->total_price = $total_price;
            $repair->save();
            DB::commit();
            return redirect()->route('repairs.index')
                ->withSuccess(__('Repair created successfully.'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('repairs.index')
                ->withErrors(__('C?? l???i s???y ra vui l??ng th??? l???i sau.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        return view('invoice.index', compact('repair'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair $repair)
    {
        Repair::destroy($repair->id);
        return redirect()->route('repairs.index')
            ->withSuccess(__('Repair delete successfully.'));
    }

    public function parseName($name)
    {
        $split = explode(" ", $name);
        return new Fluent([
            'first_name' => array_shift($split),
            'last_name' => implode(" ", $split),
        ]);
    }

    public function calculateTotal($services, $components, $quatities)
    {
        try {
            $total = null;
            if ($components != null && $quatities != null) {
                if (count($components) > 1) {
                    foreach (Component::find($components) as $key => $item) {
                        $total += $item->price * $quatities[$key];
                    }
                } else {
                    $total += (int)Component::find($components)->first()->price * $quatities[0];
                }
            }
            if ($services != null) {
                if (count($services) > 1) {
                    foreach (Service::find($services) as $item) {
                        $total += (int)$item->price;
                    }
                } else {
                    $total += (int)Service::find($services)->first()->price;
                }
            }
            return $total;
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

    public function getCar(Request $request)
    {
        $cars = Car::where('user_id', $request->id)->pluck('number_plate', 'id');
        return view('repair.partials.car', compact('cars'));
    }
}

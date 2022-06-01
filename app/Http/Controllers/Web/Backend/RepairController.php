<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Attribute;
use Vanguard\Models\Car;
use Vanguard\Models\Component;
use Vanguard\Models\Repair;
use Vanguard\Models\Service;
use Vanguard\Role;
use Vanguard\User;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repairs = Repair::orderBy('id', 'desc')->simplePaginate(12);
        return view('repair.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'services' => 'required'
        ], [
            'car_id.required' => 'Phải chọn 1 xe',
            'services.required' => 'Phải chọn 1 dịch vụ',
        ]);
        try {
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
                    $repair->components()->attach([$component => ['quantity' => $request->quantities[$key]]]);
                }
                $total_price += (int)$this->calculateTotal(null, $request->components, $request->quantities);
            }
            $repair->total_price = $total_price;
            $repair->save();
            return redirect()->route('repairs.index')
                ->withSuccess(__('Repair created successfully.'));
        } catch (\Exception $e) {
            return redirect()->route('repairs.index')
                ->withErrors(__('Có lỗi sảy ra vui lòng thử lại sau.'));
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

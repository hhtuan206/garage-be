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
        $repairs = Repair::orderBy('id','desc')->simplePaginate(12);
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
        $components = Component::all()->pluck('name', 'id');
        if (\request()->user_id != null) {
            $user = User::findOrFail(\request()->user_id);
        }
        $data = [
            'edit' => false,
            'attributes' => $attributes,
            'services' => $services,
            'components' => $components,
            'customer' => $user ?? null,
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

        $full_name = $this->parseName($request->full_name);
        $user = User::updateOrCreate(['phone' => $request->phone], [
            'phone' => $request->phone,
            'email' => $request->email,
            'first_name' => $full_name->first_name,
            'last_name' => $full_name->last_name,
            'address' => $request->address ?? "",
            'role_id' => Role::where('name', 'User')->first()->id,
            'status' => 'ACTIVE',
        ]);

        $car = Car::updateOrCreate(['number_plate' => $request->number_plate], [
            'number_plate' => $request->number_plate,
            'engine_number' => $request->engine_number,
            'user_id' => $user->id,
        ]);

        if ($request->has('attribute')) {
            $car->attributes()->sync($request->attribute);
            if (count($request->attribute) > 1) {
                foreach ($request->attribute as $key => $attribute) {
                    $car->values()->sync([$request->values[$key] => ['attribute_id' => $attribute]]);
                }
            } else {
                $car->values()->sync([$request->values => ['attribute_id' => $request->attributes[0]]]);
            }
        }

        if ($request->has('services') && $request->has('components')) {
            $repair = Repair::create([
                'car_id' => $car->id,
                'user_id' => $user->id,
                'total_price' => (string)$this->calculateTotal($request->services, $request->components, $request->quantities)
            ]);
            $repair->services()->sync($request->services);
            if (count($request->components) > 1) {
                foreach ($request->components as $key => $component) {

                    $repair->components()->attach([$component => ['quantity' => $request->quantities[$key]]]);
                }
            } else {

                $repair->components()->attach([$request->components => ['quantity' => $request->quantities[0]]]);
            }
        }

        return redirect()->route('repairs.index')
            ->withSuccess(__('Repair created successfully.'));
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

        $total = null;
        if (count($components) > 1) {
            foreach (Component::find($components) as $key => $item) {
                $total += $item->price * $quatities[$key];
            }
        } else {
            $total += Component::find($components)->first()->price * $quatities;
        }
        if (count($services) > 1) {
            foreach (Service::find($services) as $item) {
                $total += $item->price;
            }
        } else {
            $total += Service::find($services)->first()->price;
        }

        return $total;
    }
}

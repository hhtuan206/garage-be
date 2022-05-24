<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Attribute;
use Vanguard\Models\Car;
use Vanguard\User;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::orderBy('created_at', 'desc')->simplePaginate(6);
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::all()->pluck('name', 'id');
        $users = User::orderBy('id', 'desc')->get()->pluck('info', 'id');
        return view('car.add-edit', [
            'edit' => false,
            'users' => $users,
            'attributes' => $attributes
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
//        dd($request->all());
        $car = Car::updateOrCreate(['number_plate' => $request->number_plate], [
            'number_plate' => $request->number_plate,
            'engine_number' => $request->engine_number,
            'user_id' => $request->user_id,
        ]);

        if ($request->has('attribute')) {
            $car->attributes()->sync($request->attribute);
            if (count($request->attribute) > 1) {
                $car->values()->detach();
                foreach ($request->attribute as $key => $attribute) {
                    $car->values()->attach([$request->values[$key] => ['attribute_id' => $attribute]]);
                }
            } else {
                $car->values()->sync([$request->values => ['attribute_id' => $request->attributes[0]]]);
            }
        }
        return redirect()->route('cars.index')
            ->withSuccess(__('Thêm xe thành công.'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

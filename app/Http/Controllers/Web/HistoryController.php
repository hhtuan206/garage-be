<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Color;
use Vanguard\Models\Component;
use Vanguard\Models\Customer;
use Vanguard\Models\Detail;
use Vanguard\Models\Manufacturer;
use Vanguard\Models\Service;
use Vanguard\Models\Type;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histories = Detail::simplePaginate(6);
        return view('history.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all()->pluck('name', 'id');
        $types = Type::all()->pluck('name', 'id');
        $manufacturers = Manufacturer::all()->pluck('name', 'id');
        $services = Service::where('status', 1)->pluck('name', 'id');
        $components = Component::where('stock', '>', 0)->pluck('name', 'id');
        return view('history.add-edit', [
            'edit' => false,
            'colors' => $colors,
            'types' => $types,
            'manufacturers' => $manufacturers,
            'services' => $services,
            'components' => $components,
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
        dd($request->all());
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

    public function findCustomer(Request $request)
    {
        $customer = Customer::where('full_name', 'like', '%' . $request->full_name . '%')->first();
        return view('history.partials.customer', ['customer' => $customer]);
    }

    public function renderComponent(Request $request)
    {
        $components = Component::findOrFail($request->component);
        return view('history.partials.component',compact('components'));
    }

}

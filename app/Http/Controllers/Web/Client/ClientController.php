<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Category;
use Vanguard\Models\Component;
use Vanguard\Models\Service;

class ClientController extends Controller
{

    public function index()
    {
        return view('customer.index');
    }


    public function about()
    {
        return view('customer.about');
    }


    public function service()
    {
        $services = Service::where('status', 'active')->orderBy('id', 'desc')->simplePaginate(6);
        return view('customer.service', compact('services'));
    }

    public function component()
    {
        $components = Component::orderBy('id', 'desc')->simplePaginate(12);
        $categories = Category::where('type', 'component')->get();
        return view('customer.component', compact('components', 'categories'));
    }

    public function getDetailComponent($id)
    {
        $component = Component::findOrFail($id);
        return response()->json([
            'name' => $component->name,
            'image' => $component->image,
            'price' =>$component->prices,
            'unit' =>$component->unit,
            'description' => $component->description,
        ]);
    }

}

<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Category;
use Vanguard\Models\Component;
use Vanguard\Models\News;
use Vanguard\Models\Repair;
use Vanguard\Models\Service;
use Vanguard\Role;
use Vanguard\User;

class ClientController extends Controller
{
    const STAFF = 'staff';

    public function index()
    {
        $users = Role::where('name', self::STAFF)->first()->users;
        $components = Component::all();
        $services = Service::all();
        $repairs = Repair::all();
        $news = News::orderBy('created_at','desc')->get();
        return view('customer.index', compact('users', 'components', 'services','repairs','news'));
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
            'price' => $component->prices,
            'unit' => $component->unit,
            'description' => $component->description,
        ]);
    }

}

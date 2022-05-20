<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
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
        $services = Service::where('status','active')->orderBy('id','desc')->simplePaginate(6);
        return view('customer.service',compact('services'));
    }

    public function component()
    {
        return view('customer.component');
    }

}

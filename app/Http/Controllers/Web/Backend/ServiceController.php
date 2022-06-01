<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Vanguard\Exports\ServicesExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Imports\ServicesImport;
use Vanguard\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Service::query();
        if ($request->has('status') && $request->status != '') {
            $query->where('status' ,$request->status);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where('name' ,'like','%'.$request->search.'%');
        }

        $services = $query->orderBy('updated_at', 'desc')->simplePaginate(12);
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.add-edit', ['edit' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::create($request->all());
        return redirect()->route('services.index')
            ->withSuccess(__('Service created successfully.'));
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
    public function edit(Service $service)
    {
        return view('service.add-edit', ['edit' => true, 'service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        Service::find($service->id)->update($request->all());
        return redirect()->route('services.index')
            ->withSuccess(__('Service update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return redirect()->route('services.index')
            ->withSuccess(__('Service delete successfully.'));
    }


}

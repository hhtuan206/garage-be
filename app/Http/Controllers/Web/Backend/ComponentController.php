<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Category;
use Vanguard\Models\Component;

class ComponentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $components = Component::orderBy('id','desc')->simplePaginate(6);
        return view('component.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type','component')->get()->pluck('name','id');
        return view('component.add-edit', ['edit' => false, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Component::create($request->all());
        return redirect()->route('components.index')
            ->withSuccess(__('Component create successfully.'));
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
    public function edit(Component $component)
    {
        $categories = Category::where('type','component')->get()->pluck('name','id');
        return view('component.add-edit', ['edit' => true, 'component' => $component,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        Component::find($component->id)->update($request->all());
        return redirect()->route('components.index')
            ->withSuccess(__('Component update successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        Component::destroy($component->id);
        return redirect()->route('components.index')
            ->withSuccess(__('Component delete successfully.'));
    }

    public function renderComponent(Request $request)
    {
        $components = Component::find((array)$request->component);
        return view('repair.partials.component', compact('components'));
    }

    public function updateStock(Request $request, $id)
    {
        $compnent =  Component::find($id);
        $compnent->stock = (int)$request->stock + (int)$compnent->stock;
        $compnent->save();
        return redirect()->route('components.index')
            ->withSuccess(__('Cập nhật tồn kho thành công'));
    }

}

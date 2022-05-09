<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Attribute;
use Vanguard\Models\Value;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('attribute.index-attribute', compact('attributes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Attribute::create($request->all());
        return redirect()->route('attributes.index')
            ->withSuccess(__('Attribute created successfully.'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('attribute.edit-attribute', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        Attribute::find($attribute->id)->update($request->all());
        return redirect()->route('attributes.index')
            ->withSuccess(__('Attribute updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        Attribute::destroy($attribute->id);
        return redirect()->route('attributes.index')
            ->withSuccess(__('Attribute detele successfully.'));
    }

    public function editValue(Attribute $attribute)
    {
        return view('attribute.index-attribute-value', compact('attribute'));
    }

    public function renderAttribute(Request $request)
    {

        $attributes = Attribute::find((array)$request->attribute);
        return view('repair.partials.attribute', compact('attributes'));
    }
}

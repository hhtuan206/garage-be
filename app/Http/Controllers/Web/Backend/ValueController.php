<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Value;

class ValueController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Value::create($request->all());
        return redirect()->back()
            ->withSuccess(__('Attribute detele successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Value $value)
    {
        return view('attribute.edit-attribute-value',compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Value $value)
    {
        Value::find($value->id)->update($request->all());
        return redirect()->route('attribute.editAttributeValue',$value->attribute_id)
            ->withSuccess(__('Attribute detele successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Value $value)
    {
        Value::destroy($value->id);
        return redirect()->back()
            ->withSuccess(__('Attribute detele successfully.'));
    }
}

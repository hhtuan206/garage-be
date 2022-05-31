<?php

namespace Vanguard\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Models\Site;
use function PHPUnit\Framework\isEmpty;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except('_token') as $type => $content) {
            $site = Site::where('type', $type)->first();
            $site->content = $content;
            $site->save();

        }
        return redirect()->route('site.index')
            ->withSuccess(__('Site config update successfully.'));
    }

}

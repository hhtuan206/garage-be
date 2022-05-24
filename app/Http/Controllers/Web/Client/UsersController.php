<?php

namespace Vanguard\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\User;

class UsersController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        return view('customer.profile', [
            'user' => $user,
            'edit' => true
        ]);
    }

    public function update(Request $request,User $user)
    {
        $user->update($request->all());
        return redirect()->back()->withSuccess(__('Cập nhật tài khoản thành công.'));
    }

    public function repair()
    {
        $repairs = \Auth::user()->repairs->sortByDesc('created_at');
        return view('customer.repair',compact('repairs'));
    }

    public function invoice()
    {

    }

}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}

<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|unique:users',
            'username'=> 'required|max:50',
            'password'=> 'required|min:4'
        ]);
        $email = $request['email'];
        $username = $request['username'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->password = $password;

        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password'=> 'required'
        ]);
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])|| Auth::attempt(['username'=>$request['email'],'password'=>$request['password']]))
        {
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
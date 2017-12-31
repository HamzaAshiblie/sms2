<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Calendar;

use App\Event;
class UserController extends Controller
{
    public function getDashboard()
    {
        $events = [];

        $data = Event::all();

        if($data->count()){

            foreach ($data as $key => $value) {

                $events[] = Calendar::event(

                    $value->title,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date.' +1 day')

                );

            }

        }

        $calendar = Calendar::addEvents($events);
        return view('dashboard', compact('calendar'));
    }
    public function getAccount()
    {
        return view('account',['user'=> Auth::user()]);
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
        $user->name = $username;
        $user->password = $password;

        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'=> 'required'
        ]);
        $message = 'البريد الالكتروني أو كلمة المرور غير صحيحة';
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])|| Auth::attempt(['username'=>$request['email'],'password'=>$request['password']]))
        {
            return redirect()->route('dashboard');
        }
        else{
            return redirect('home')->with('message',$message);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
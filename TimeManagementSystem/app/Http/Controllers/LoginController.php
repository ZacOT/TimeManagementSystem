<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function validateLogin(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();


        if ($user) {
            Auth::login($user);
            $role = Auth::user()->role;

            if ($role == 0) {
                return redirect('/')->with('status',Auth::user()->f_name);
            }
            if ($role == 1) {
                return redirect('/attendance')->with('status',Auth::user()->f_name);
            }
            if ($role == 2) {
                return redirect('/managecourses')->with('status',Auth::user()->f_name);
            }
            if ($role == 3) {
                return redirect('/admin');
            }
        }


        return back()->with('status', 'Incorrect Credentials. If you believe this is an error, please contact support.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function register()
    {
    }
}

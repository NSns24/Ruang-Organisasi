<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Helper;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Helper::validate($request, $rules);

        if($validator->fails()) {
            return back()->withErrors($validator, 'login')->withInput();
        }
        
        $credentials = $request->only('email', 'password');

        if(auth()->attempt($credentials)) {
            return back()->with('success', 'Login Success');
        }
        else {
            return back()->with('errorLogin', 'Username or Password is wrong')->withInput();
        }
    }

    public function logout() 
    {
        session()->flush();
        auth()->logout();
        return redirect('/');
    }
}

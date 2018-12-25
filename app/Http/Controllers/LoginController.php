<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Helper;

class LoginController extends Controller
{
    public function login(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Helper::validate($request, $rules);

        if($validator->fails()) {
            return back()->withErrors($validator, 'login')->withInput();
        }

        $user = User::where('email', $request->email)->first();
    
        if(!$user || decrypt($user->password) != $request->password) {
            return back()->with('errorLogin', 'Username or Password is wrong')->withInput();
        }
        else {
            session(['currentUser' => $user]);
            return back()->with('success', 'Login Success');
        }
    }

    public function logout() {
        session()->flush();
        return redirect('/');
    }
}

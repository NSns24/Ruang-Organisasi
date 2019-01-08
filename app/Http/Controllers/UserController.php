<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|between:4,30',
            'password' => 'required|between:6,10',
            'confirm_password' => 'same:password',
            'contact_number' => 'required|digits_between:10,15',
            'profile_picture' => 'required|image'
        ];

        $validator = Helper::validate($request, $rules);

        if($validator->fails()) {
            return back()->withErrors($validator, 'register')->withInput();
        }

        $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());

        if($user->exists) {
            $filename = $user->id.'_'.$user->name.'.'.$request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(public_path().'/assets/image/user/', $filename);
            $user->profile_picture = $filename;
            
            if($user->save()) {
                auth()->login($user);
                return back()->with('success', 'Register Success');
            }
        }

        return Helper::errorProcess();
    }
}

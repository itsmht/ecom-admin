<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    function login()
    {
        return view('auth.login');
    }
    function loginSubmit(Request $req)
    {
        $req->validate(
            [
                'admin_phone' => 'required',
                'admin_password' => 'required',
            ],
            [
                'admin_phone.required' => 'Please Enter Your Phone Number',
                //'email.email' => 'Please Enter A Valid Email Address',
                'admin_password.required' => 'Please Enter Your Password',
            ]

        ); //Validating User Authentication Information
        $user = Admin::where('admin_phone', $req->admin_phone)->where('admin_password',$req->admin_password)->first(); //Authentication
        if($user)
        {
            if($user->admin_status=="1")//Checking If User Status is Active
            {
                if($user->admin_type=="1")//Checking User Type, Redirecting To Admin Dashboard And Creating Session
                {
                    session()->put('logged', $user->admin_phone);
                    return redirect()->route('adminDashboard');
                }
                if($user->admin_type=="2")//Checking User Type, Redirecting To Admin Dashboard And Creating Session
                {
                    session()->put('logged', $user->admin_phone);
                    return redirect()->route('adminDashboard');
                }
            }
            else
            {
                return redirect()->route("login")->with('message','Your account is not approved yet!');
            }
        }
        else
        {
            return redirect()->route("login")->with('message','The credentials does not match!');
        }
    }
    function logout()
    {
        session()->forget('logged'); //Session destroyed
        session()->flash('msg','Sucessfully Logged out');
        return redirect()->route('login');
    }
}

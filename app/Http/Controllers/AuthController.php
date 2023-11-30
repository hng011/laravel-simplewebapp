<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect(route('admin.dashboard'));
        } else {
            return view('auth.login');
        }
    }

    public function startLogin(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=> 'required'
        ]);

        $d = [
            'email' => $req->email,
            'password'=> $req->password,
        ];

        if(Auth::attempt($d)){
            return redirect(route('admin.dashboard'))->with('msg','Successfully Logged In');
        } else {
            return redirect(route('login'))->with('msg','Incorrect username/password!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('/'))->with('msg',"You're logged out");
    }
}

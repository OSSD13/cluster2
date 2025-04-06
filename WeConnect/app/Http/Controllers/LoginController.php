<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $req) {
        $user = User::where('email', $req->email)->first();

        if($user != null && Hash::check($req->password, $user->password)) {
            $req->session()->put('user', $user);
            if ($user->role === 'Admin') {
                return redirect('/adduser');
            } else if ($user->role === 'Manager') {
                return redirect('/dashboard');
            } else if ($user->role === 'User') {
                return redirect('/home');
            }
        } else {
            $req->session()->flash('error', 'กรุณาตรวจสอบข้อมูลอีกครั้ง'); //แดงแต่รันได้ intelephense น่าจะรุ่นเก่ากว่า
            return redirect('/login');
        }
    }
}

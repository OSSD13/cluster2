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
<<<<<<< HEAD
                return redirect('/adminhome');
=======
                return redirect('/manage_user');
>>>>>>> b3f26f8f7862b08511f747ef900598b1121c48dd
            } else if ($user->role === 'Manager') {
                return redirect('/dashboard');
            } else if ($user->role === 'User') {
                return redirect()->route('userhome');
            }
        } else {
            $req->session()->flash('error', 'กรุณาตรวจสอบข้อมูลอีกครั้ง'); //แดงแต่รันได้ intelephense น่าจะรุ่นเก่ากว่า
            return redirect('login');
        }
    }

    function logout(Request $req) {
        $req->session()->forget('user');
        return redirect('/login');
    }

}

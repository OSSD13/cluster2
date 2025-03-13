<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
<<<<<<< HEAD
class LoginController extends Controller
{
    //
    function index(){
    return view('login');
    }
    function login(Request $req){
        // print_r($req->input());
        $user = User::where('email' , $req->email)->first();
        // print_r($user);
        if($user != null && Hash::check($req->password, $user->password)){
            $req->session()->put('user' , $user);
            return redirect('/users');
        }else{
            $req->session()->flash('error', 'กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return redirect('/login');
        }
=======

class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $req) {
        $user = User::where('email', $req->email)->first();
        if($user != null && Hash::check($req->password, $user->password)) {
            $req->session()->put('user',$user);
            return redirect('/adduser');
        }
        // if($user != null && Hash::check($req->password, $user->password)) {
        //     // $req->session()->put('user',$user);
        //     return redirect('/welcome');
        // } else {
        //     $req->session()->flash('error', 'กรุณาตรวจสอบข้อมูลอีกครั้ง'); //แดงแต่รันได้ intelephense น่าจะรุ่นเก่ากว่า
        //     //return redirect('/login');
        // }
>>>>>>> eb532cc02114d2622d68e0ee1dd1ecead4a868de
    }
}

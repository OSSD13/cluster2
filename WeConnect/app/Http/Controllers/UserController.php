<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    function addUser(Request $req) {
        $muser = new User();
        $muser->name = $req->name;
        $muser->email = $req->email;
        $muser->password = $req->password;
        $muser->role = $req->role;
        $muser->save();

        $users = User::all();
        return view('usersManager', compact('users'));
    }

    function viewAddUser() {
        return view('/adduser');
    }

    public function index() {
        $users = User::all();
        return view('usersManager', compact('users'));
    }

}


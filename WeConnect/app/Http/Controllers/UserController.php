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
        return view('admin.manage_user', compact('users'));
    }

    function viewAddUser() {
        return view('/admin.add_user');
    }

    public function index() {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('admin.edit_user', compact('user'));
    }
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.manage_user');
    }
    public function showUser($id){
        $user = User::where('usr_id', $id)->first(); // ค้นหาผู้ใช้ที่มี 'id' เท่ากับ $id
        return view('layouts.manage_user', compact('user'));

    }

}


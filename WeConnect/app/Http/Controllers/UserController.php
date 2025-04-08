<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    function addUser(Request $req)
    {
        $muser = new User();
        $muser->name = $req->name;
        $muser->email = $req->email;
        $muser->password = $req->password;
        $muser->role = $req->role;
        $muser->save();

        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }

    function viewAddUser()
    {
        return view('/admin.add_user');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.manage_user', compact('users'));
    }

    public function viewEditUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_edit', compact('user'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'ผู้ใช้ถูกลบเรียบร้อยแล้ว');
    }
}


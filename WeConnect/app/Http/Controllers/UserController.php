<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('usersManager', compact('users'));
    }

    public function create() {
        return view('AddUser'); // ไปที่ view ที่คุณสร้างไว้
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new \App\Models\User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->save();

        return redirect()->route('users.index')->with('success', 'สร้างบัญชีผู้ใช้เรียบร้อยแล้ว!');
    }

}



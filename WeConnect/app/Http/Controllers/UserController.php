<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function delete($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect('/usermanage')->with('success', 'User deleted successfully.');
    }

    return redirect('/usermanage')->with('error', 'User not found.');
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;

    // กรณีมีการแก้ไขรหัสผ่าน
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect('/usermanage')->with('success', 'User updated successfully.');
}

public function viewEditUser($id)
{
    $user = User::where('usr_id', $id)->firstOrFail();
    return view('admin.edit_user', compact('user'));
}
}

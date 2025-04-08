<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;

use Illuminate\Support\Facades\Route;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/usermanage', [UserController::class, 'index']);
Route::get('/adduser', [UserController::class, 'viewAddUser']);
Route::post('/adduser', [UserController::class, 'addUser']);

// Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
Route::get('/home', [ProblemController::class, 'index'])->name('home');
Route::post('/home', [ProblemController::class, 'home']);

Route::get('/problemdetail', function () {
    return view('user.problem_detail');
});
Route::post('/problemdetail', function () {
    return view('user.problem_detail');
});

Route::get('/addproblem', function () {
    return view('user.add_problem');
});

Route::get('/editproblem', function () {
    return view('user.edit_problem');
});

Route::get('/address', function () {
    return view('user.add_address');
});

Route::get('/testproblem', function () {
    return view('test_problem');
});

Route::get('/dashboard', function () {
    return view('manager.dashboard');
});

Route::get('/editaddress', function () {
    return view('user.edit_address');
});

Route::get('/maps', function () {
    return view('user.open_map');
});

// Route::get('/edituser/{id}', [UserController::class, 'viewEditUser']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.user_edit');

Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

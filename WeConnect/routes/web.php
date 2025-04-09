<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\TagController;

use Illuminate\Support\Facades\Route;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/usermanage', [UserController::class, 'index']);
Route::get('/adduser', [UserController::class, 'viewAddUser']);
Route::post('/adduser', [UserController::class, 'addUser']);

// Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
Route::get('/home', [ProblemController::class, 'index'])->name('userhome');
Route::post('/home', [ProblemController::class, 'home']);
Route::get('/home/search', [ProblemController::class, 'search'])->name('home.search');

Route::get('/problemdetail', function () {
    return view('user.problem_detail');
});
Route::post('/problemdetail',function (){
    return view('user.problem_detail');
});

Route::get('/addproblem',function (){
    return view('user.add_problem');
});

Route::get('/editproblem',function (){
    return view('user.edit_problem');
});

Route::get('/addmap',function (){
    return view('user.add_map');
});

Route::get('/address',function (){
    return view('user.add_address');
});

Route::get('/testproblem',function (){
    return view('test_problem');
});

Route::get('/testaddproblem',function (){
    return view('test_addproblem');
});

Route::get('/dashboard',function (){
    return view('manager.dashboard');
});

Route::get('/editaddress',function (){
    return view('user.edit_address');
});

Route::get('/maps', [ProblemController::class, 'showMap'])->name('user.open_map.view');


Route::post('/addimage', [ProblemController::class, 'addimage']);
Route::post('/showimage', [ProblemController::class, 'showimage']);

// Route::get('/edituser/{id}', [UserController::class, 'viewEditUser']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.user_edit');

Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/users', [UserController::class, 'search'])->name('admin.manage_user');

Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.edit_user');

Route::put('/updateuser/{id}', [UserController::class, 'updateUser'])->name('user.update');

Route::post('/tags',
[TagController::class, 'store'])->name('tags.store');
Route::get('/tags/fetch',
[TagController::class, 'fetch'])->name('tags.fetch');
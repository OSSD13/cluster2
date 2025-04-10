<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CheckLogin;

use Illuminate\Support\Facades\Route;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// USER
Route::middleware([CheckLogin::class])->group(function () {
    // Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
    Route::get('/home', [ProblemController::class, 'index'])->name('userhome');
    Route::post('/home', [ProblemController::class, 'home']);
    Route::post('/home', [ProblemController::class, 'addForm'])->name('home.add');
    Route::get('/home/search', [ProblemController::class, 'search'])->name('home.search');

    Route::get('/problemdetail/{prob_id}', [ProblemController::class, 'show'])->name('problem.show');
    Route::post('/problemdetail', function () {
        return view('user.problem_detail');
    });
    Route::get('/editproblem/{prob_id}', [ProblemController::class, 'edit'])->name('problem.edit');
    Route::put('/editproblem/{prob_id}', [ProblemController::class, 'update'])->name('problem.update');

    Route::get('/addproblem', function () {
        return view('user.add_problem');
    })->name('addproblem');

    Route::get('/addmap', function () {
        return view('user.add_map');
    })->name("addmap");

    Route::post('/addproblem', [ProblemController::class, 'addForm'])->name('addproblem');

    Route::delete('/deleteproblem/{id}', [ProblemController::class, 'delete'])->name('problem.delete');

    Route::get('/maps', [ProblemController::class, 'showMap'])->name('user.open_map.view');

    Route::get('/autocomplete-tags', [App\Http\Controllers\ProblemController::class, 'autocomplete']);

    Route::post(
        '/tags',
        [TagController::class, 'store']
    )->name('tags.store');
    Route::get(
        '/tags/fetch',
        [TagController::class, 'fetch']
    )->name('tags.fetch');
});

// ADMIN
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/usermanage', [UserController::class, 'index'])->name('usermanage');
    Route::get('/adduser', [UserController::class, 'viewAddUser'])->name('adduser');
    Route::post('/adduser', [UserController::class, 'addUser'])->name('adduser');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/users', [UserController::class, 'search'])->name('admin.manage_user');

    Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.edit_user');

    Route::put('/updateuser/{id}', [UserController::class, 'updateUser'])->name('user.update');
});


// หน้า dashboard หลัก
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData']);
Route::get('/dashboard', [DashboardController::class, 'countProblem'])->name('dashboard');

Route::get('/editaddress', function () {
    return view('user.edit_address');
});

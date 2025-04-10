<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CheckLogin;

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
    });

    Route::get('/addmap', function () {
        return view('user.add_map');
    })->name("addmap");

    Route::post('/addproblem', [ProblemController::class, 'addForm']);

    Route::delete('/deleteproblem/{id}', [ProblemController::class, 'delete'])->name('problem.delete');

    Route::get('/maps', [ProblemController::class, 'showMap'])->name('user.open_map.view');

    Route::get('/autocomplete-tags', [App\Http\Controllers\TagController::class, 'autocomplete']);
});

Route::get('/address', function () {
    return view('user.add_address');
});

Route::get('/testproblem', function () {
    return view('test_problem');
});

Route::get('/testaddproblem', function () {
    return view('test_addproblem');
});

Route::get('/dashboard', function () {
    return view('manager.dashboard');
});

Route::get('/editaddress', function () {
    return view('user.edit_address');
});


Route::post('/addimage', [ProblemController::class, 'addimage'])->name('addimage');
Route::post('/showimage', [ProblemController::class, 'showimage'])->name('showimage');

// Route::get('/edituser/{id}', [UserController::class, 'viewEditUser']);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.user_edit');

Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/users', [UserController::class, 'search'])->name('admin.manage_user');

Route::get('/edituser/{id}', [UserController::class, 'viewEditUser'])->name('admin.edit_user');

Route::put('/updateuser/{id}', [UserController::class, 'updateUser'])->name('user.update');

Route::post(
    '/tags',
    [TagController::class, 'store']
)->name('tags.store');
Route::get(
    '/tags/fetch',
    [TagController::class, 'fetch']
)->name('tags.fetch');

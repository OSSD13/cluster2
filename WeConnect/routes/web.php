<?php
/*
 * @Author: Nattapong Kamma Icezazarun@gmail.com
 * @Date: 2025-03-13 11:12:25
 * @LastEditors: Nattapong Kamma Icezazarun@gmail.com
 * @LastEditTime: 2025-04-08 15:09:16
 * @FilePath: \cluster2\WeConnect\routes\web.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

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

// Route::get('/adddata', [ProblemController::class, 'adddata'])->name('adddata');
// Route::post('/adddata', [ProblemController::class, 'adddata']);


// Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
Route::get('/home', [ProblemController::class, 'index'])->name('home');
Route::post('/home', [ProblemController::class, 'home']);

Route::get('/problemdetail/{prob_id}', [ProblemController::class, 'show'])->name('problem.show');



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
Route::post('/editproblem',function (){
    return view('user.edit_problem');
});

Route::get('/address',function (){
    return view('user.add_address');
});

Route::get('/testproblem',function (){
    return view('test_problem');
});

Route::get('/dashboard',function (){
    return view('manager.dashboard');
});

Route::get('/editaddress',function (){
    return view('user.edit_address');
});

Route::get('/maps',function(){
    return view('user.open_map');
});

Route::get('/maps', [ProblemController::class, 'showMap'])->name('user.open_map.view');


Route::get('/edituser',function(){
    return view('admin.edit_user');
});

Route::get('/addmap',function (){
    return view('user.add_map');
});

Route::get('/home/search', [ProblemController::class, 'search'])->name('home.search');


Route::get('/editproblem/{prob_id}', [ProblemController::class, 'edit'])->name('problem.edit');
Route::put('/editproblem/{prob_id}', [ProblemController::class, 'update'])->name('problem.update');


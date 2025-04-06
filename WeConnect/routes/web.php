<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProblemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/adduser', [UserController::class, 'index']);
Route::post('/adduser', [UserController::class, 'addUser']);

Route::get('/problem', function() {
    return view('problem');
});

Route::post('/addproblem', [ProblemController::class, 'addForm']);

Route::get('/dashboard', function() {
    return view('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/ProblemDetail',function (){
    return view('ProblemDetail');
});

Route::get('/AddData',function (){
    return view('AddData');
});

Route::get('/EditData',function (){
    return view('EditData');
});

Route::get('/Address',function (){
    return view('Address');
});

Route::get('/EditAddress',function (){
    return view('EditAddress');
});

Route::get('/confirmDelete',function (){
    return view('Delete');
});
Route::get('/home',
[HomeController::class, 'index']);

Route::resource('/users', UserController::class);

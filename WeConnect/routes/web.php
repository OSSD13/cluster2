<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function() {
    return view('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
});
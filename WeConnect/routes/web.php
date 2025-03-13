<?php

<<<<<<< HEAD

=======
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
>>>>>>> eb532cc02114d2622d68e0ee1dd1ecead4a868de
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/adduser', [UserController::class, 'index']);
Route::post('/adduser', [UserController::class, 'addUser']);

Route::get('/welcome', function () {
    return view('welcome');
<<<<<<< HEAD
});

Route::get('/login',
[LoginController::class, 'index']);

Route::post('/login',
[LoginController::class, 'login']);
=======
});
>>>>>>> eb532cc02114d2622d68e0ee1dd1ecead4a868de

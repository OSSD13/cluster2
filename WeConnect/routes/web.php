<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemController;



use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/adduser', [UserController::class, 'index']);
Route::post('/adduser', [UserController::class, 'addUser']);

Route::get('/adddata', [ProblemController::class, 'adddata'])->name('adddata');
Route::post('/adddata', [ProblemController::class, 'adddata']);


// Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'home']);

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/problemdetail', function () {
    return view('problemdetail');
});
Route::get('/adddata',function (){
    return view('adddata');
});

Route::get('/editdata',function (){
    return view('editdata');
});
Route::post('/editdata',function (){
    return view('editdata');
});

Route::get('/address',function (){
    return view('address');
});

Route::get('/editaddress',function (){
    return view('editaddress');
});

?>

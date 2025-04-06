<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/adduser', [UserController::class, 'index']);
Route::post('/adduser', [UserController::class, 'addUser']);

// Route::get('/', [HomeController::class, 'index']); // เส้นนี้สำคัญสุด
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'home']);

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/problemdetail', function () {
    return view('problemdetail');
});
Route::get('/addData',function (){
    return view('AddData');
});

Route::get('/editData',function (){
    return view('EditData');
});

Route::get('/address',function (){
    return view('Address');
});

Route::get('/editAddress',function (){
    return view('EditAddress');
});
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/problems/create', function () {
//     return "หน้าเพิ่มข้อมูล"; // เปลี่ยนเป็น view ตามจริง
// })->name('problems.create');

Route::get('/confirmDelete',function (){
    return view('Delete');
});

Route::get('/home',
[HomeController::class, 'index']);

Route::resource('/users', UserController::class);

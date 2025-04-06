<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('adduser');
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
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'login'])->name('login');

Route::get('/dashboard', [HomeController::class, 'dashboard']);

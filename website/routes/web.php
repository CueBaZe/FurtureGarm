<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimecapsuleController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/login', [Authcontroller::class, 'login'])->name('loginpost');

Route::post('/register', [AuthController::class, 'register'])->name('registerpost');

Route::post('/timecapsule', [TimecapsuleController::class, 'createTimecapsule'])->middleware('auth')->name('timecapsuleCreate');
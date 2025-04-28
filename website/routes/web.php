<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimecapsuleController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::post('/timecapsule', [TimecapsuleController::class, 'createTimecapsule'])->middleware('auth')->name('timecapsuleCreate');

    Route::post('/timecapsuledel', [TimecapsuleController::class, 'deleteTimecapsule'])->middleware('auth')->name('timecapsuleDelete');

});


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/logout', [Authcontroller::class, 'logout'])->name('logout');

Route::post('/login', [Authcontroller::class, 'login'])->name('loginpost');

Route::post('/register', [AuthController::class, 'register'])->name('registerpost');

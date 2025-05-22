<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimecapsuleController;
use App\Http\Controllers\AccController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::post('/timecapsule', [TimecapsuleController::class, 'createTimecapsule'])->middleware('auth')->name('timecapsuleCreate');

    Route::post('/timecapsuledel', [TimecapsuleController::class, 'deleteTimecapsule'])->middleware('auth')->name('timecapsuleDelete');

    Route::delete('/timecapsule/{id}', [TimecapsuleController::class, 'deleteTimecapsule'])->name('timecapsule.delete');

    Route::get('/accountifo', function() {
        return view('account');
    })->name('account');

    Route::post('/accountinfochange', [AccController::class, 'changeAccInfo'])->middleware('auth')->name('changeAccInfo');

    Route::get('/accountdelete', [AccController::class, 'DeleteAcc'])->middleware('auth')->name('deleteAcc');

    Route::get('/settings', function() {
        return view('settings');
    })->name('settings');

    Route::post('/settingssave', [SettingController::class, 'saveSettings'])->name('saveSetting');

    Route::get('/settingsreset', [SettingController::class, 'resetSettings'])->name('resetSetting');

});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/get-media/{id}', [TimecapsuleController::class, 'getMediaPath'])->name('getMedia');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('loginpost');

Route::post('/register', [AuthController::class, 'register'])->name('registerpost');

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::match(['get', 'post'], '/create', [TrackingController::class, 'create'])->name('create');

Route::get('/track/{id}', [TrackingController::class, 'track'])
    ->name('track');

Route::post('/track/{id}/update', [TrackingController::class, 'update'])
    ->name('update');

Route::post('/track/{id}/deliver', [TrackingController::class, 'deliver'])
    ->name('update');

// Login Routes

Route::view('/login', 'login')
    ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});
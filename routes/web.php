<?php

use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::match(['get', 'post'], '/create', [TrackingController::class, 'create'])->name('create');

Route::get('/track/{id}', [TrackingController::class, 'track'])
    ->name('track');

Route::post('/track/{id}/update', [TrackingController::class, 'update'])
    ->name('update');

Route::post('/track/{id}/deliver', [TrackingController::class, 'deliver'])
    ->name('update');

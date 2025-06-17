<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\V1\BetController;


Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(BetController::class)->group(function () {
        Route::get('/bets/list', 'index')->name('bets.list');
        Route::get('/bets/show/id', 'show')->name('bets.show');
        Route::get('/bets/create', 'create')->name('bets.create');
        Route::get('/bets/reports', 'index')->name('bets.reports');
        Route::post('/bets/store', 'store')->name('bets.store');
    });
});

require __DIR__ . '/auth.php';

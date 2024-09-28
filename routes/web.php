<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
})->name('home');


Route::controller(LoginController::class)
    ->middleware('guest')
    ->prefix('/admin/login')
    ->group(function () {
        Route::get('/', 'create')->name('admin.login');
        Route::post('/', 'store')->name('admin.login.store');
    });

Route::middleware('auth')
    ->prefix('/admin')
    ->name("admin.")
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

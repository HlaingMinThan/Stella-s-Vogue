<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\MustBeAdminMiddleware;
use App\Http\Middleware\MustBeAuthUser;
use App\Http\Middleware\MustBeStaffUser;
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

Route::middleware(MustBeAuthUser::class)
    ->prefix('/admin')
    ->name("admin.")
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(MustBeAdminMiddleware::class);
        Route::get('collections', [CollectionController::class, 'index'])->name('collections.index')->middleware(MustBeAdminMiddleware::class);
        Route::get('collections/create', [CollectionController::class, 'create'])->name('collections.create')->middleware(MustBeAdminMiddleware::class);
        Route::post('collections/store', [CollectionController::class, 'store'])->name('collections.store')->middleware(MustBeAdminMiddleware::class);
        Route::get('collections/{collection}/edit', [CollectionController::class, 'edit'])->name('collections.edit')->middleware(MustBeAdminMiddleware::class);
        Route::put('collections/{collection}/update', [CollectionController::class, 'update'])->name('collections.update')->middleware(MustBeAdminMiddleware::class);
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index')->middleware(MustBeAdminMiddleware::class, MustBeStaffUser::class);
        Route::post('logout', [LogoutController::class, 'destroy'])
            ->name('logout');
    });

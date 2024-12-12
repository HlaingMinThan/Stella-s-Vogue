<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\MustBeAdminMiddleware;
use App\Http\Middleware\MustBeAuthUser;
use App\Http\Middleware\MustBeGuestUser;
use App\Http\Middleware\MustBeStaffUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
})->name('home');


Route::controller(LoginController::class)
    ->middleware(MustBeGuestUser::class)
    ->prefix('/admin/login')
    ->group(function () {
        Route::get('/', 'create')->name('admin.login');
        Route::post('/', 'store')->name('admin.login.store');
    });

Route::middleware(MustBeAuthUser::class)
    ->prefix('/admin')
    ->name("admin.")
    ->group(function () {
        //reports
        Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard')->middleware(MustBeAdminMiddleware::class);

        // collections
        Route::get('collections', [CollectionController::class, 'index'])->name('collections.index')->middleware(MustBeAdminMiddleware::class);
        Route::get('collections/create', [CollectionController::class, 'create'])->name('collections.create')->middleware(MustBeAdminMiddleware::class);
        Route::post('collections/store', [CollectionController::class, 'store'])->name('collections.store')->middleware(MustBeAdminMiddleware::class);
        Route::get('collections/{collection}/edit', [CollectionController::class, 'edit'])->name('collections.edit')->middleware(MustBeAdminMiddleware::class);
        Route::put('collections/{collection}/update', [CollectionController::class, 'update'])->name('collections.update')->middleware(MustBeAdminMiddleware::class);
        Route::delete('collections/{collection}/destroy', [CollectionController::class, 'destroy'])->name('collections.destroy')->middleware(MustBeAdminMiddleware::class);

        // orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index')->middleware([MustBeStaffUser::class]);
        Route::get('orders/{order}/order-details', [OrderController::class, 'details'])->name('orders.details.index')->middleware([MustBeStaffUser::class]);
        Route::delete('orderdetails/{orderDetail}/delete', [OrderController::class, 'orderDetailDelete'])->name('orderdetail.destroy')->middleware([MustBeStaffUser::class]);
        Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware(MustBeStaffUser::class);
        Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store')->middleware(MustBeStaffUser::class);
        Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit')->middleware([MustBeStaffUser::class]);
        Route::post('orders/{order}/update', [OrderController::class, 'update'])->name('orders.update')->middleware([MustBeStaffUser::class]);
        Route::delete('orders/{order}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware(MustBeAdminMiddleware::class);

        // order details
        Route::get('/collections/{collection}/order_details', [OrderDetailController::class, 'index'])->name('order_details.index')->middleware([MustBeStaffUser::class]);
        Route::get('/collections/{collection}/order_details/create', [OrderDetailController::class, 'create'])->name('order_details.create')->middleware([MustBeStaffUser::class]);
        Route::post('/collections/{collection}/order_details/store', [OrderDetailController::class, 'store'])->name('order_details.store')->middleware([MustBeStaffUser::class]);
        Route::get('order_details/{orderDetail}/edit', [OrderDetailController::class, 'edit'])->name('order_details.edit')->middleware([MustBeStaffUser::class]);
        Route::post('order_details/{orderDetail}/update', [OrderDetailController::class, 'update'])->name('order_details.update')->middleware([MustBeStaffUser::class]);
        Route::delete('order_details/{orderDetail}/delete', [OrderDetailController::class, 'destroy'])->name('order_details.destroy')->middleware([MustBeStaffUser::class]);

        Route::post('logout', [LogoutController::class, 'destroy'])
            ->name('logout');
    });

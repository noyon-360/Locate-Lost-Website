<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'login_view'])->name('admin.login.view');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('user/{id}', [AdminController::class, 'userProfile'])->name('users.profile');

        Route::get('pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pending_users');
        Route::get('users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');

        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
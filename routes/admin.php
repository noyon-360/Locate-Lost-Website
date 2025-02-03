<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminStationController;
use App\Http\Controllers\MissingPersonController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'login_view'])->name('admin.login.view');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


        Route::get('pending-account', [AdminController::class, 'pendingAccounts'])->name('admin.pending_accounts');
        Route::get('station/{id}/approve', [AdminController::class, 'approveStation'])->name('admin.station.approve');

        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});


Route::middleware(['auth:admin,station'])->group(function () {
    Route::get('user-profile/{id}', [AdminStationController::class, 'userProfile'])->name('users.profile');
    Route::get('/station-profile/{id}', [AdminStationController::class, 'stationProfile'])->name('station-profile');

    Route::get('/all_location/{id}', [MissingPersonController::class, 'showAllLandmarks'])->name('all-landmarks');

    Route::get('users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.user.approve');
    Route::get('users/{id}/reject', [AdminController::class, 'rejectUser'])->name('admin.user.reject');
});

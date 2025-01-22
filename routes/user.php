<?php

use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => 'guest'], function () {
        // Authenticated page route
        Route::get('/login', [UserAuthController::class, 'login_view'])->name('login-view');
        Route::post('/login', [UserAuthController::class, 'login'])->name('login');

        Route::get('/register', [UserAuthController::class, 'register_view'])->name('register-view');
        Route::post('/register', [UserAuthController::class, 'register'])->name('register');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
        Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

        Route::get('profile', [UserController::class, 'showProfile'])->name('user.profile');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::delete('/profile/delete', [UserController::class, 'deleteAccount'])->name('user.profile.delete');

        
        Route::get('/response/edit/{id}', [ResponseController::class, 'edit'])->name('edit-response');
        Route::put('/response/update/{id}', [ResponseController::class, 'update'])->name('response.update');
        Route::delete('/response/delete/{id}', [ResponseController::class, 'destroy'])->name('response.delete');
    });
});
<?php

use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StationAuthController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'station'], function () {
    Route::group(['middleware' => 'guest'], function () {
        // Authenticated page route
        Route::get('/login', [StationAuthController::class, 'login_view'])->name('station.login-view');
        Route::post('/login', [StationAuthController::class, 'login'])->name('station.login');

        Route::get('/register', [StationAuthController::class, 'register_view'])->name('station.register-view');
        Route::post('/register', [StationAuthController::class, 'register'])->name('station.register');
    });

    Route::group(['middleware' => 'station.auth'], function () {
        Route::get('/dashboard', [StationAuthController::class, 'dashboard'])->name('station.dashboard');
        Route::post('/logout', [StationAuthController::class, 'logout'])->name('station.logout');


        // Mising Report Add, success, edit, update

        // Add missing person route
        Route::get('/add-missing-person', [MissingPersonController::class, 'missiongPersonView'])->name('add-missing-person');
        // Route::get('/add-missing-person', function () {
        //     return view('missing_person.add_missing_person');
        // })->name('add-missing-person');

        Route::post('/submit-missing-person', [MissingPersonController::class, 'store'])->name('submit-missing-person');
        Route::get('/missing-person-success/{id}', [MissingPersonController::class, 'showSuccess'])->name('missing-person-success');

        Route::get('/edit-missing-person/{id}', [MissingPersonController::class, 'edit'])->name('edit-missing-person');
        Route::put('/update-missing-person/{id}', [MissingPersonController::class, 'update'])->name('update-missing-person');



        // Route::get('profile', [StationController::class, 'showProfile'])->name('user.profile');
        Route::put('/profile/update', [StationController::class, 'updateProfile'])->name('station.profile.update');
        Route::delete('/profile/delete', [StationController::class, 'deleteAccount'])->name('station.profile.delete');
        
        
        
        Route::post('/complete-missing-report/{id}', [MissingPersonController::class, 'missingPersonCompletion'])->name('complete-missing-report');

        // Route::get('/response/edit/{id}', [ResponseController::class, 'edit'])->name('edit-response');
        // Route::put('/response/update/{id}', [ResponseController::class, 'update'])->name('response.update');
        // Route::delete('/response/delete/{id}', [ResponseController::class, 'destroy'])->name('response.delete');
    });
});

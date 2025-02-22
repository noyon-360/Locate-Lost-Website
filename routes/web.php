<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Models\MissingPerson;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'view'])->name('welcome');

// Missing Report route
Route::get('/missing-reports', [HomeController::class, 'index'])->name('missing-reports');

// Route::group(['prefix' => 'admin'], function () {
//     Route::group(['middleware' => 'admin.guest'], function () {
//         Route::get('/login', [AdminController::class, 'login_view'])->name('admin.login.view');
//         Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
//     });

//     Route::group(['middleware' => 'admin.auth'], function () {
//         Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//         Route::get('pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pending_accounts');
//         Route::get('users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.user.approve');

//         Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
//     });
// });


// Route::group(['prefix' => 'user'], function () {
//     Route::group(['middleware' => 'guest'], function () {
//         // Authenticated page route
//         Route::get('/login', [UserAuthController::class, 'login_view'])->name('login-view');
//         Route::post('/login', [UserAuthController::class, 'login'])->name('login');

//         Route::get('/register', [UserAuthController::class, 'register_view'])->name('register-view');
//         Route::post('/register', [UserAuthController::class, 'register'])->name('register');
//     });

//     Route::group(['middleware' => 'auth'], function () {
//         Route::get('/dashboard', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
//         Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

//         Route::get('profile', [UserController::class, 'showProfile'])->name('user.profile');
//         Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
//         Route::delete('/profile/delete', [UserController::class, 'deleteAccount'])->name('user.profile.delete');


//         Route::get('/response/edit/{id}', [ResponseController::class, 'edit'])->name('edit-response');
//         Route::put('/response/update/{id}', [ResponseController::class, 'update'])->name('response.update');
//         Route::delete('/response/delete/{id}', [ResponseController::class, 'destroy'])->name('response.delete');
//     });
// });



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('map', [LocationController::class, 'showMapForm']);
Route::post('map', [LocationController::class, 'storeLocation']);






Route::middleware(['auth:web,admin,station'])->group(function () {

    // Route::get('/profile/{id}', [ProfileController::class, 'stationProfile'])->name('station-profile');

    // Route::post('/submit-missing-person', [MissingPersonController::class, 'store'])->name('submit-missing-person');

    // Route::get('/missing-person-success/{id}', [MissingPersonController::class, 'showSuccess'])->name('missing-person-success');

    // Route::get('/edit-missing-person/{id}', [MissingPersonController::class, 'edit'])->name('edit-missing-person');
    // Route::put('/update-missing-person/{id}', [MissingPersonController::class, 'update'])->name('update-missing-person');


    Route::get('/person/{id}', [MissingPersonController::class, 'person_details_show'])->name('person.details');
    Route::get('/missing_person/{id}/add_info', [MissingPersonController::class, 'addInfo'])->name('missing_person.add_info');
    Route::post('/missing_person/{id}/store_info', [MissingPersonController::class, 'storeInfo'])->name('missing_person.store_info');

    // Route::get('user/{id}', [AdminController::class, 'userProfile'])->name('users.profile');

    Route::get('/location/{id}', [MissingPersonController::class, 'showLocation'])->name('show-location');
    


    Route::delete('/report/update/{id}', [MissingPersonController::class, 'destroy'])->name('report.delete');

    // Response routes
    Route::get('/response/edit/{id}', [ResponseController::class, 'edit'])->name('edit-response');
    Route::put('/response/update/{id}', [ResponseController::class, 'update'])->name('response.update');
    Route::delete('/response/delete/{id}', [ResponseController::class, 'destroy'])->name('response.delete');


    // comment routes
    Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment.store');
});


// Route::middleware(['auth:web, admin'])->get('/add-missing-person', [MissingPersonController::class, 'missiongPersonView'])->name('add-missing-person');
// Route::get('/add-missing-person', [MissingPersonController::class, 'missiongPersonView'])->name('add-missing-person');

// Route::post('/submit-missing-person', [MissingPersonController::class, 'store'])->name('submit-missing-person');


// Admin routes
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });
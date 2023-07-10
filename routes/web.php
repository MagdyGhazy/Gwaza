<?php

use App\Enums\UserRoleEnum;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP */

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/', function () {
            return view('auth.login');
        });
    });

    Route::group(['middleware' => ['CheckUserType']], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::view('/Admin_profile', 'Admin.profile')->name('Admin_profile');


        Route::resource('posts', PostController::class);

        Route::resource('/comments', CommentController::class);
    });
});


Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

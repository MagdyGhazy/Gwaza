<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

        Route::controller(AuthController::class)->group(function () {
            Route::post('/login', 'login');
            Route::post('/register',  'register');
            Route::post('/logout', 'logout');
            Route::post('/refresh','refresh');
            Route::get('/user-profile', 'userProfile');
            Route::post('/edit-profile', 'edit');
    });

});
Route::group([
    'middleware' => 'CheckUserTypeApi',
    'prefix' => 'auth'
],function () {

    Route::controller(PostController::class)->group(function () {
        Route::post('/delPost/{id}', 'destroy');
    });
    Route::controller(\App\Http\Controllers\Api\CommentController::class)->group(function () {
        Route::post('/delComment/{id}', 'destroy');
    });

});

Route::group([
    'middleware' => 'UserAuth',
    'prefix' => 'auth',
],function () {

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index');
        Route::post('/addPost',  'store');
        Route::post('/editPost/{id}', 'update');
        Route::post('/customDelPost/{id}', 'customDestroy');
    });

    Route::controller(\App\Http\Controllers\Api\CommentController::class)->group(function () {
        Route::get('/comments', 'index');
        Route::post('/addComment',  'store');
        Route::post('/editComment/{id}', 'update');
        Route::post('/customDelComment/{id}', 'customDestroy');
    });

});


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

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index');
        Route::post('/addPost',  'store');
        Route::post('/delPost/{id}', 'destroy');
        Route::post('/editPost/{id}', 'update');
    });

});


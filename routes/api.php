<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------     ------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//USERS
//Route::prefix('/user')->group( function() {
//    Route::post('/login', [\App\Http\Controllers\api\v1\LoginController::class, 'login']);
//});
//Route::post('login',[\App\Http\Controllers\AuthController::class, 'login']);
//Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);
//Route::middleware('auth:api')->get('user', [\App\Http\Controllers\AuthController::class, 'user']);
//Route::middleware('auth:api')->get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);

        // Users CRUD API
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
        Route::post('store', [\App\Http\Controllers\UserController::class, 'store_user']);
        Route::post('user_update/{id}', [\App\Http\Controllers\UserController::class, 'update']);
        Route::get('user_delete/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);

        // Tags CRUD API
        Route::post('store_tag', [\App\Http\Controllers\TagController::class, 'store_tag']);
        Route::get('tags-list', [\App\Http\Controllers\TagController::class, 'index']);
        Route::get('tag_delete/{id}', [\App\Http\Controllers\TagController::class, 'destroy']);
        Route::post('update_tag/{id}', [\App\Http\Controllers\TagController::class, 'updateTag']);


        // Categories CRUD API
        Route::group([
            'prefix' => 'category'
        ], function () {
            Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);
            Route::post('store_category', [\App\Http\Controllers\CategoryController::class, 'store_category']);
            Route::post('update/{id}', [\App\Http\Controllers\CategoryController::class, 'updateCategory']);
            Route::get('delete/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
        });

        Route::get('publishers', [\App\Http\Controllers\PublisherController::class, 'index']);
        Route::post('publisher/create', [\App\Http\Controllers\PublisherController::class, 'store']);
        Route::delete('publisher/delete/{id}', [\App\Http\Controllers\PublisherController::class, 'destroy']);
    });


});

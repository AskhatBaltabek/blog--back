<?php

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

Route::post('/login', '\App\Http\Controllers\AuthController@login');

Route::middleware('auth:api')->group(function() {
    Route::get('/user', '\App\Http\Controllers\UserController@user');

    Route::post('/delete_user', '\App\Http\Controllers\UserController@deleteUser');
    Route::get('/users', '\App\Http\Controllers\UserController@users');
    Route::post('/store_user', '\App\Http\Controllers\UserController@storeUser');

    Route::get('/posts', '\App\Http\Controllers\PostController@getPosts');
    Route::get('/posts/{id}', '\App\Http\Controllers\PostController@index');

    Route::get('roles', '\App\Http\Controllers\RoleController@getRoles');
});

Route::get('/test', '\App\Http\Controllers\UserController@test');

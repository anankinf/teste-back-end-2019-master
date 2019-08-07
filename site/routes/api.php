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




Route::prefix('auth')->group( function (){
    Route::post('/login', 'LoginController@accessToken');
    Route::post('/logout', 'LoginController@revokeToken')->middleware('auth:api');
    Route::post('/refresh', 'LoginController@refreshToken');

    Route::post('/me', 'UserController@me')->middleware('auth:api');
});
Route::middleware('auth:api')->group(function () {
    Route::resource('products', 'ProductsController');
});




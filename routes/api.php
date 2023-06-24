<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::apiResource('restaurants', 'RestaurantController');
    Route::get('restaurants/{restaurant}/menus', 'MenuController@index');
    Route::get('menus/{menu}', 'MenuController@show');
    Route::get('restaurants/{restaurant}/menus', 'MenuController@index');
    Route::get('restaurants/{restaurant}/orders', 'OrderController@index');
    Route::get('orders/{order}', 'OrderController@show');
});


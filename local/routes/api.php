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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('api_customer_login', 'API1Controller@api_customer_login');
Route::post('api_customer_register', 'API1Controller@api_customer_register');
Route::post('api_get_user', 'API1Controller@api_get_user');
Route::post('api_get_provinces', 'API1Controller@api_get_provinces');
Route::post('api_get_amphures', 'API1Controller@api_get_amphures');
Route::post('api_get_districts', 'API1Controller@api_get_districts');



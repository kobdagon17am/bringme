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
Route::post('api_get_zipcode', 'API1Controller@api_get_zipcode');
Route::post('api_register_store', 'API1Controller@api_register_store');
Route::post('api_change_select_type', 'API1Controller@api_change_select_type');
Route::post('api_forget_password', 'API1Controller@api_forget_password');
Route::post('api_reset_password', 'API1Controller@api_reset_password');
Route::post('api_get_flashsale', 'API1Controller@api_get_flashsale');
Route::post('api_customer_new_address', 'API1Controller@api_customer_new_address');
Route::post('api_get_category', 'API1Controller@api_get_category');
Route::post('api_get_brand', 'API1Controller@api_get_brand');
Route::post('api_get_product_filter', 'API1Controller@api_get_product_filter');


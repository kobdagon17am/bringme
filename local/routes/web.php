<?php

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
Route::get('/c', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');


    // $exitCode = Artisan::call('config:cache');
    return back();
  });

Route::get('payment_form', 'PaymentController@payment_form');
Route::get('api_test', 'PaymentController@api_test');
Route::post('payment_form/complete', 'PaymentController@payment_complete')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('payment_complete', 'PaymentController@payment_complete_backend')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

require_once 'web-admin.php';
require_once 'web-customer.php';


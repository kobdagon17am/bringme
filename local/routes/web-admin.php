<?php


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

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // $exitCode = Artisan::call('config:cache');

    return back();
  });

Route::get('admin/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('admin/home', 'Admin/HomeController@index')->name('Admin/home');
Route::get('admin/employee', 'Admin/EmployeeController@index')->name('admin/employee');

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


Route::get('admin', function () {
    return view('auth/loginadmin');
});

Route::get('admin', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('admin/home');
    } else {
        return view('auth/loginadmin');
    }
})->name('admin');

Route::post('admin_login', 'Customer\LoginController@admin_login')->name('admin_login');

Route::get('admin/home', 'Admin\HomeController@index')->name('admin/home');
Route::get('admin/employee', 'Admin\EmployeeController@index')->name('admin/employee');


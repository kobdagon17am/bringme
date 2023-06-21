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


Route::get('admin/', function () {
    return view('auth/loginadmin');
});

Route::get('/admin', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('admin/home');
    } else {
        return view('auth/loginadmin');
    }
})->name('admin_home');

    Route::prefix('admin')->group(function () {
    Route::get('home', 'Admin/HomeController@index')->name('home');
    Route::get('employee', 'Admin/EmployeeController@index')->name('employee');
});


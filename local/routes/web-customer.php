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



Auth::routes();
  Route::get('/', function () {

    // if(session('id')){
    if (Auth::guard('customer')->check()) {
      return redirect('home');
    }else{
      return view('Auth/logincustomer');
    }
  });



  Route::get('home', 'Customer\HomeController@index')->name('home');
  Route::get('employee', 'Customer\EmployeeController@index')->name('employee');

  Route::get('employee-add', function () {
    return view('Customer/employee-add');
  })->name('employee-add');


  ?>




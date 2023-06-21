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

Route::get('/c', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // $exitCode = Artisan::call('config:cache');
    return back();
  });
  Route::get('/', function () {

    // if(session('id')){
    if(Auth()->check()){
      return redirect('home');
    }else{
      return view('Auth/login');
    }
  });

  Route::get('home', 'Customer\HomeController@index')->name('home');
  Route::get('employee', 'Customer\EmployeeController@index')->name('employee');


  ?>




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

Route::get('/', function () {

  // if(session('id')){
  if(Auth::guard('c_user')->check()){
    dd('success');
    return redirect('profile');
  }else{
    return view('auth/logincustomer');
  }
});

Route::get('logout', function () {
    Auth::guard('c_user')->logout();
    //Session::flush();
    return redirect('login');
  })->name('logout');


  ?>




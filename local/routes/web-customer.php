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


Route::get('/', function () {
    return view('Customer.home');

  // if(session('id')){
//   if(Auth::guard('c_user')->check()){
//     return view('Customer.home');
//     return redirect('home');
//   }else{
//     // return view('auth/logincustomer');
//     return view('Customer.home');
//   }
});

Route::get('logout', function () {
    // Auth::guard('c_user')->logout();
    //Session::flush();
    return redirect('login');
  })->name('logout');


  Route::get('home', function () {
    return view('Customer.home');
  });


  ?>




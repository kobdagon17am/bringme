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

  Route::get('permission', function () {
    return view('Customer/permission');
  })->name('permission');

  Route::get('users', function () {
    return view('Customer/users');
  })->name('users');


  Route::get('stores', function () {
    return view('Customer/stores');
  })->name('stores');

  Route::get('stores-waitapproved', function () {
    return view('Customer/stores-waitapproved');
  })->name('stores-waitapproved');

  Route::get('products', function () {
    return view('Customer/products');
  })->name('products');

  Route::get('products-waitapproved', function () {
    return view('Customer/products-waitapproved');
  })->name('products-waitapproved');

  Route::get('transaction', function () {
    return view('Customer/transaction');
  })->name('transaction');

  Route::get('refund', function () {
    return view('Customer/refund');
  })->name('refund');

  Route::get('campaign', function () {
    return view('Customer/campaign');
  })->name('campaign');

  Route::get('user-store', function () {
    return view('Customer/user-store');
  })->name('user-store');

  Route::get('user-store-product-add', function () {
    return view('Customer/user-store-product-add');
  })->name('user-store-product-add');

  Route::get('user-store-product-edit', function () {
    return view('Customer/user-store-product-edit');
  })->name('user-store-product-edit');

  Route::get('orders', function () {
    return view('Customer/orders');
  })->name('orders');

  Route::get('discount-code', function () {
    return view('Customer/discount-code');
  })->name('discount-code');

  Route::get('promo-discount-product', function () {
    return view('Customer/promo-discount-product');
  })->name('promo-discount-product');

  Route::get('promo-free-gift', function () {
    return view('Customer/promo-free-gift');
  })->name('promo-free-gift');

  Route::get('promo-bundle-deal', function () {
    return view('Customer/promo-bundle-deal');
  })->name('promo-bundle-deal');

  Route::get('promo-add-on', function () {
    return view('Customer/promo-add-on');
  })->name('promo-add-on');

  Route::get('profile-edit', function () {
    return view('Customer/profile-edit');
  })->name('profile-edit');

  Route::get('receive-product', function () {
    return view('Customer/receive-product');
  })->name('receive-product');

  Route::get('order-detail', function () {
    return view('Customer/order-detail');
  })->name('order-detail');

  Route::get('orders', function () {
    return view('Customer/orders');
  })->name('orders');

  Route::get('orders', function () {
    return view('Customer/orders');
  })->name('orders');

  Route::get('products-awaiting-delivery', function () {
    return view('Customer/products-awaiting-delivery');
  })->name('products-awaiting-delivery');

  Route::get('create-bill-lading', function () {
    return view('Customer/create-bill-lading');
  })->name('create-bill-lading');

  Route::get('bill-lading', function () {
    return view('Customer/bill-lading');
  })->name('bill-lading');

  Route::get('check-stock', function () {
    return view('Customer/check-stock');
  })->name('check-stock');

  ?>




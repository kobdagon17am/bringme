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

Route::get('/register_partner', 'PaymentController@register_partner')->name('register_partner');
Route::post('store_create', 'PaymentController@store_create');

Route::get('/get_amphures', 'PaymentController@get_amphures');
Route::get('/get_districes', 'PaymentController@get_districes');
Route::get('/get_zipcode', 'PaymentController@get_zipcode');

Auth::routes();
Route::get('/', function () {

      return view('index');

  });




  Route::get('/login', function () {

    // if(session('id')){
    if (Auth::guard('customer')->check()) {
      return redirect('home');
    }else{

      return view('auth/logincustomer');
    }
  })->name('login');

  Route::post('customer_login', 'Customer\LoginController@customer_login')->name('customer_login');


  Route::get('home', 'Customer\HomeController@index')->name('home');
  Route::get('employee', 'Customer\EmployeeController@index')->name('employee');

  Route::get('store-register', 'Customer\StoreRegisterController@index')->name('store-register');







  Route::get('employee-add', function () {
    return view('frontend/employee-add');
  })->name('employee-add');

  Route::get('permission', function () {
    return view('frontend/permission');
  })->name('permission');

  Route::get('users', function () {
    return view('frontend/users');
  })->name('users');


  Route::get('stores', function () {
    return view('frontend/stores');
  })->name('stores');

  Route::get('stores-waitapproved', function () {
    return view('frontend/stores-waitapproved');
  })->name('stores-waitapproved');

  Route::get('products', function () {
    return view('frontend/products');
  })->name('products');

  Route::get('products-waitapproved', function () {
    return view('frontend/products-waitapproved');
  })->name('products-waitapproved');

  Route::get('transaction', function () {
    return view('frontend/transaction');
  })->name('transaction');

  Route::get('refund', function () {
    return view('frontend/refund');
  })->name('refund');

  Route::get('campaign', function () {
    return view('frontend/campaign');
  })->name('campaign');

  Route::get('user-store', function () {
    return view('frontend/user-store');
  })->name('user-store');

  Route::get('user-store-product-add', function () {
    return view('frontend/user-store-product-add');
  })->name('user-store-product-add');

  Route::get('user-store-product-edit', function () {
    return view('frontend/user-store-product-edit');
  })->name('user-store-product-edit');

  Route::get('orders', function () {
    return view('frontend/orders');
  })->name('orders');

  Route::get('discount-code', function () {
    return view('frontend/discount-code');
  })->name('discount-code');

  Route::get('promo-discount-product', function () {
    return view('frontend/promo-discount-product');
  })->name('promo-discount-product');

  Route::get('promo-free-gift', function () {
    return view('frontend/promo-free-gift');
  })->name('promo-free-gift');

  Route::get('promo-bundle-deal', function () {
    return view('frontend/promo-bundle-deal');
  })->name('promo-bundle-deal');

  Route::get('promo-add-on', function () {
    return view('frontend/promo-add-on');
  })->name('promo-add-on');

  Route::get('profile-edit', function () {
    return view('frontend/profile-edit');
  })->name('profile-edit');

  Route::get('receive-product', function () {
    return view('frontend/receive-product');
  })->name('receive-product');

  Route::get('order-detail', function () {
    return view('frontend/order-detail');
  })->name('order-detail');

  Route::get('orders', function () {
    return view('frontend/orders');
  })->name('orders');

  Route::get('orders', function () {
    return view('frontend/orders');
  })->name('orders');

  Route::get('products-awaiting-delivery', function () {
    return view('frontend/products-awaiting-delivery');
  })->name('products-awaiting-delivery');

  Route::get('create-bill-lading', function () {
    return view('frontend/create-bill-lading');
  })->name('create-bill-lading');

  Route::get('bill-lading', function () {
    return view('frontend/bill-lading');
  })->name('bill-lading');

  Route::get('check-stock', function () {
    return view('frontend/check-stock');
  })->name('check-stock');

  ?>




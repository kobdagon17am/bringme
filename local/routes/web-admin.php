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

Route::get('admin/employee-add', function () {
    return view('Admin/employee-add');
  })->name('admin/employee-add');

  Route::get('admin/permission', function () {
    return view('Admin/permission');
  })->name('admin/permission');

  Route::get('admin/users', function () {
    return view('Admin/users');
  })->name('admin/users');


  Route::get('admin/stores', 'Admin\StoresController@index')->name('admin/stores');

  Route::get('admin/stores_datable', 'Admin\StoresController@stores_datable')->name('admin/stores_datable');
  Route::post('admin/stores_confirmation', 'Admin\StoresController@stores_confirmation')->name('admin/stores_confirmation');



  Route::get('admin/stores-detail', function () {
    return view('Admin/store-detail');
  })->name('admin/store-detail');

  Route::get('admin/stores-waitapproved', function () {
    return view('Admin/stores-waitapproved');
  })->name('admin/stores-waitapproved');

  Route::get('admin/products', function () {
    return view('Admin/products');
  })->name('admin/products');

  Route::get('admin/products-waitapproved', function () {
    return view('Admin/products-waitapproved');
  })->name('admin/products-waitapproved');

  Route::get('admin/transaction', function () {
    return view('Admin/transaction');
  })->name('admin/transaction');

  Route::get('admin/refund', function () {
    return view('Admin/refund');
  })->name('admin/refund');

  Route::get('admin/campaign', function () {
    return view('Admin/campaign');
  })->name('admin/campaign');

  Route::get('admin/user-store', function () {
    return view('Admin/user-store');
  })->name('admin/user-store');

  Route::get('admin/user-store-product-add', function () {
    return view('Admin/user-store-product-add');
  })->name('admin/user-store-product-add');

  Route::get('admin/user-store-product-edit', function () {
    return view('Admin/user-store-product-edit');
  })->name('admin/user-store-product-edit');

  Route::get('admin/orders', function () {
    return view('Admin/orders');
  })->name('admin/orders');

  Route::get('admin/discount-code', function () {
    return view('Admin/discount-code');
  })->name('admin/discount-code');

  Route::get('admin/promo-discount-product', function () {
    return view('Admin/promo-discount-product');
  })->name('admin/promo-discount-product');

  Route::get('admin/promo-free-gift', function () {
    return view('Admin/promo-free-gift');
  })->name('admin/promo-free-gift');

  Route::get('admin/promo-bundle-deal', function () {
    return view('Admin/promo-bundle-deal');
  })->name('admin/promo-bundle-deal');

  Route::get('admin/promo-add-on', function () {
    return view('Admin/promo-add-on');
  })->name('admin/promo-add-on');

  Route::get('admin/profile-edit', function () {
    return view('Admin/profile-edit');
  })->name('admin/profile-edit');

  Route::get('admin/receive-product', function () {
    return view('Admin/receive-product');
  })->name('admin/receive-product');

  Route::get('admin/order-detail', function () {
    return view('Admin/order-detail');
  })->name('admin/order-detail');

  Route::get('admin/orders', function () {
    return view('Admin/orders');
  })->name('admin/orders');

  Route::get('admin/orders', function () {
    return view('Admin/orders');
  })->name('admin/orders');

  Route::get('admin/products-awaiting-delivery', function () {
    return view('Admin/products-awaiting-delivery');
  })->name('admin/products-awaiting-delivery');

  Route::get('admin/create-bill-lading', function () {
    return view('Admin/create-bill-lading');
  })->name('admin/create-bill-lading');

  Route::get('admin/bill-lading', function () {
    return view('Admin/bill-lading');
  })->name('admin/bill-lading');

  Route::get('admin/check-stock', function () {
    return view('Admin/check-stock');
  })->name('admin/check-stock');








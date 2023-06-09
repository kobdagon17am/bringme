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

Route::get('admin/admin_datable', 'Admin\EmployeeController@admin_datable')->name('admin/admin_datable');

Route::post('admin/employee_add', 'Admin\EmployeeController@employee_add')->name('admin/employee_add');

Route::get('admin/products', 'Admin\ProductsController@index')->name('admin/products');
Route::get('admin/products_datable', 'Admin\ProductsController@products_datable')->name('admin/products_datable');

Route::get('admin/products-waitapproved', 'Admin\ProductsController@products_waitapproved')->name('admin/products-waitapproved');
Route::get('admin/products_waitapproved_datable', 'Admin\ProductsController@products_waitapproved_datable')->name('admin/products_waitapproved_datable');

Route::get('admin/products-waitapproved-detail/{id}', 'Admin\ProductsController@products_waitapproved_detail')->name('admin/products-waitapproved-detail');

Route::post('admin/product_confirmation}', 'Admin\ProductsController@product_confirmation')->name('admin/product_confirmation');
Route::post('admin/item_confirmation}', 'Admin\ProductsController@item_confirmation')->name('admin/item_confirmation');

Route::get('admin/product-edit/{id}', 'Admin\ProductsController@product_edit')->name('admin/product-edit');

// Update : 13/07/2023
Route::get('admin/employee-edit/{id}', 'Admin\EmployeeController@employee_edit')->name('admin/employee-edit');
Route::post('admin/employee_update', 'Admin\EmployeeController@employee_update')->name('admin/employee_update');





// Route::get('admin/employee-edit', function () {
//     return view('backend/employee-edit');
//   })->name('admin/employee-edit');


Route::get('admin/employee-add', function () {
    return view('backend/employee-add');
  })->name('admin/employee-add');

  Route::get('admin/permission', function () {
    return view('backend/permission');
  })->name('admin/permission');

  Route::get('admin/users', function () {
    return view('backend/users');
  })->name('admin/users');


  Route::get('admin/stores', 'Admin\StoresController@index')->name('admin/stores');

  Route::get('admin/stores_datable', 'Admin\StoresController@stores_datable')->name('admin/stores_datable');
  Route::post('admin/stores_confirmation', 'Admin\StoresWaitapprovedController@stores_confirmation')->name('admin/stores_confirmation');

  Route::get('admin/stores_waitapproved_datable', 'Admin\StoresWaitapprovedController@stores_waitapproved_datable')->name('admin/stores_waitapproved_datable');



  Route::get('admin/stores-detail', function () {
    return view('backend/store-detail');
  })->name('admin/stores-detail');

  Route::get('admin/stores-waitapproved', function () {
    return view('backend/stores-waitapproved');
  })->name('admin/stores-waitapproved');









  Route::get('admin/transaction', function () {
    return view('backend/transaction');
  })->name('admin/transaction');

  Route::get('admin/refund', function () {
    return view('backend/refund');
  })->name('admin/refund');

  Route::get('admin/campaign', function () {
    return view('backend/campaign');
  })->name('admin/campaign');

  Route::get('admin/user-store', function () {
    return view('backend/user-store');
  })->name('admin/user-store');

  Route::get('admin/user-store-product-add', function () {
    return view('backend/user-store-product-add');
  })->name('admin/user-store-product-add');

  Route::get('admin/user-store-product-edit', function () {
    return view('backend/user-store-product-edit');
  })->name('admin/user-store-product-edit');

  Route::get('admin/orders', function () {
    return view('backend/orders');
  })->name('admin/orders');

  Route::get('admin/discount-code', function () {
    return view('backend/discount-code');
  })->name('admin/discount-code');

  Route::get('admin/promo-discount-product', function () {
    return view('backend/promo-discount-product');
  })->name('admin/promo-discount-product');

  Route::get('admin/promo-free-gift', function () {
    return view('backend/promo-free-gift');
  })->name('admin/promo-free-gift');

  Route::get('admin/promo-bundle-deal', function () {
    return view('backend/promo-bundle-deal');
  })->name('admin/promo-bundle-deal');

  Route::get('admin/promo-add-on', function () {
    return view('backend/promo-add-on');
  })->name('admin/promo-add-on');

  Route::get('admin/profile-edit', function () {
    return view('backend/profile-edit');
  })->name('admin/profile-edit');

  Route::get('admin/receive-product', function () {
    return view('backend/receive-product');
  })->name('admin/receive-product');

  Route::get('admin/order-detail', function () {
    return view('backend/order-detail');
  })->name('admin/order-detail');

  Route::get('admin/orders', function () {
    return view('backend/orders');
  })->name('admin/orders');

  Route::get('admin/orders', function () {
    return view('backend/orders');
  })->name('admin/orders');

  Route::get('admin/products-awaiting-delivery', function () {
    return view('backend/products-awaiting-delivery');
  })->name('admin/products-awaiting-delivery');

  Route::get('admin/create-bill-lading', function () {
    return view('backend/create-bill-lading');
  })->name('admin/create-bill-lading');

  Route::get('admin/bill-lading', function () {
    return view('backend/bill-lading');
  })->name('admin/bill-lading');

  Route::get('admin/check-stock', function () {
    return view('backend/check-stock');
  })->name('admin/check-stock');








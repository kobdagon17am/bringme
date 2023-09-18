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
Route::get('admin/product_add/{id}', 'Admin\ProductsController@product_add')->name('admin/product_add');
Route::post('admin/product_create', 'Admin\ProductsController@product_create')->name('admin/product_create');
Route::get('admin/product_edit/{id}', 'Admin\ProductsController@product_edit')->name('admin/product_edit');


Route::get('admin/products-pending-tranfer', 'Admin\ProductsController@products_pending_tranfer')->name('admin/products-pending-tranfer');
Route::get('admin/products_pending_tranfer_datatable', 'Admin\ProductsController@products_pending_tranfer_datatable')->name('admin/products_pending_tranfer_datatable');
Route::get('admin/products-waitapproved', 'Admin\ProductsController@products_waitapproved')->name('admin/products-waitapproved');
Route::get('admin/products_waitapproved_datable', 'Admin\ProductsController@products_waitapproved_datable')->name('admin/products_waitapproved_datable');
Route::get('admin/products-waitapproved-detail/{id}', 'Admin\ProductsController@products_waitapproved_detail')->name('admin/products-waitapproved-detail');
Route::get('admin/product-panding-tranfer-detail/{id}', 'Admin\ProductsController@product_panding_tranfer_detail')->name('admin/product-panding-tranfer-detail');

Route::post('admin/product_confirmation}', 'Admin\ProductsController@product_confirmation')->name('admin/product_confirmation');
Route::post('admin/item_confirmation}', 'Admin\ProductsController@item_confirmation')->name('admin/item_confirmation');
Route::post('admin/item_gallery', 'Admin\ProductsController@item_gallery')->name('admin/item_gallery');
Route::post('admin/remove_gallery', 'Admin\ProductsController@remove_gallery')->name('admin/remove_gallery');

Route::get('admin/product-edit/{id}', 'Admin\ProductsController@product_edit')->name('admin/product-edit');

// Update : 13/07/2023
Route::get('admin/employee-edit/{id}', 'Admin\EmployeeController@employee_edit')->name('admin/employee-edit');
Route::post('admin/employee_update', 'Admin\EmployeeController@employee_update')->name('admin/employee_update');


Route::get('admin/employee-add', function () {
    return view('backend/employee-add');
  })->name('admin/employee-add');

Route::get('admin/permission', 'Admin\PermissionController@index')->name('admin/permission');
Route::get('admin/permission-add', 'Admin\PermissionController@permission_add')->name('admin/permission-add');
Route::get('admin/permission-edit/{id}', 'Admin\PermissionController@permission_edit')->name('admin/permission-edit');
Route::get('admin/permission_datatable', 'Admin\PermissionController@permission_datatable')->name('admin/permission_datatable');
Route::post('admin/permission-create', 'Admin\PermissionController@permission_create')->name('admin/permission-create');
Route::post('admin/permission-update', 'Admin\PermissionController@permission_update')->name('admin/permission-update');
Route::get('admin/permission-delete/{id}', 'Admin\PermissionController@permission_delete')->name('admin/permission-delete');

Route::get('admin/setting-category', 'Admin\CategoryController@index')->name('admin/setting-category');
Route::get('admin/setting-category-add', 'Admin\CategoryController@category_add')->name('admin/setting-category-add');
Route::get('admin/setting-category-edit/{id}', 'Admin\CategoryController@category_edit')->name('admin/setting-category-edit');
Route::get('admin/setting-category_datatable', 'Admin\CategoryController@category_datatable')->name('admin/setting-category_datatable');
Route::post('admin/setting-category-create', 'Admin\CategoryController@category_create')->name('admin/setting-category-create');
Route::post('admin/setting-category-update', 'Admin\CategoryController@category_update')->name('admin/setting-category-update');
Route::get('admin/setting-category-delete/{id}', 'Admin\CategoryController@category_delete')->name('admin/setting-category-delete');

Route::get('admin/setting-brands', 'Admin\BrandsController@index')->name('admin/setting-brands');
Route::get('admin/setting-brands-add', 'Admin\BrandsController@brands_add')->name('admin/setting-brands-add');
Route::get('admin/setting-brands-edit/{id}', 'Admin\BrandsController@brands_edit')->name('admin/setting-brands-edit');
Route::get('admin/setting-brands_datatable', 'Admin\BrandsController@brands_datatable')->name('admin/setting-brands_datatable');
Route::post('admin/setting-brands-create', 'Admin\BrandsController@brands_create')->name('admin/setting-brands-create');
Route::post('admin/setting-brands-update', 'Admin\BrandsController@brands_update')->name('admin/setting-brands-update');
Route::get('admin/setting-brands-delete/{id}', 'Admin\BrandsController@brands_delete')->name('admin/setting-brands-delete');

Route::get('admin/setting-banner', 'Admin\BannerController@index')->name('admin/setting-banner');
Route::get('admin/setting-banner-add', 'Admin\BannerController@banner_add')->name('admin/setting-banner-add');
Route::get('admin/setting-banner-edit/{id}', 'Admin\BannerController@banner_edit')->name('admin/setting-banner-edit');
Route::get('admin/setting-banner_datatable', 'Admin\BannerController@banner_datatable')->name('admin/setting-banner_datatable');
Route::post('admin/setting-banner-create', 'Admin\BannerController@banner_create')->name('admin/setting-banner-create');
Route::post('admin/setting-banner-update', 'Admin\BannerController@banner_update')->name('admin/setting-banner-update');
Route::get('admin/setting-banner-delete/{id}', 'Admin\BannerController@banner_delete')->name('admin/setting-banner-delete');

Route::get('admin/user-edit/{id}', 'Admin\CustomersController@customers_view')->name('admin/users');
Route::post('admin/block_user', 'Admin\CustomersController@block_user')->name('admin/block_user');
Route::post('admin/unblock_user', 'Admin\CustomersController@unblock_user')->name('admin/unblock_user');
Route::post('admin/approve_user', 'Admin\CustomersController@approve_user')->name('admin/approve_user');



  Route::get('admin/users', 'Admin\CustomersController@index')->name('admin/users');
  Route::get('admin/customers_datable', 'Admin\CustomersController@customers_datable')->name('admin/customers_datable');
  Route::get('admin/stores', 'Admin\StoresController@index')->name('admin/stores');

  Route::get('admin/stores', 'Admin\StoresController@index')->name('admin/stores');
  Route::get('admin/stores_datable', 'Admin\StoresController@stores_datable')->name('admin/stores_datable');
  Route::get('admin/store-detail/{id}', 'Admin\StoresController@store_detail')->name('admin/store-detail');



  Route::post('admin/stores_confirmation', 'Admin\StoresWaitapprovedController@stores_confirmation')->name('admin/stores_confirmation');
  Route::get('admin/stores_waitapproved_datable', 'Admin\StoresWaitapprovedController@stores_waitapproved_datable')->name('admin/stores_waitapproved_datable');



  Route::get('admin/stores-waitapproved', function () {
    return view('backend/stores-waitapproved');
  })->name('admin/stores-waitapproved');


  Route::get('admin/store-register-detail', function () {
    return view('backend/store-register-detail');
  })->name('admin/store-register-detail');





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



  Route::get('admin/orders', 'Admin\OrdersController@order_list')->name('admin/orders');

  Route::get('admin/genbarcode/{product_id}', 'Admin\ProductsController@genbarcode')->name('admin/genbarcode');

  Route::get('admin/order-detail/{cart_id}', 'Admin\OrdersController@order_detail')->name('admin/order-detail');




  Route::get('admin/discount-code-add', function () {
    return view('backend/discount-code-add');
  })->name('admin/discount-code-add');


//   Route::get('admin/order-detail', function () {
//     return view('backend/order-detail');
//   })->name('admin/order-detail');

//   Route::get('admin/orders', function () {
//     return view('backend/orders');
//   })->name('admin/orders');

//   Route::get('admin/orders', function () {
//     return view('backend/orders');
//   })->name('admin/orders');




  Route::get('admin/products-awaiting-delivery', 'Admin\ProductsAwaitingDeliveryController@index')->name('admin/products-awaiting-delivery');



  Route::get('admin/create-bill-lading', function () {
    return view('backend/create-bill-lading');
  })->name('admin/create-bill-lading');

  Route::get('admin/bill-lading', function () {
    return view('backend/bill-lading');
  })->name('admin/bill-lading');

//   Route::get('admin/check-stock', function () {
//     return view('backend/check-stock');
//   })->name('admin/check-stock');

// Route::get('admin/orders', function () {
//     return view('backend/orders');
//   })->name('admin/orders');



  Route::get('admin/check-stock', 'Admin\StockController@check_stock')->name('admin/check-stock');









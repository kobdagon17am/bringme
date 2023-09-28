<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// API1Controller
Route::post('api_customer_login', 'API1Controller@api_customer_login');
Route::post('api_customer_register', 'API1Controller@api_customer_register');
Route::post('api_get_user', 'API1Controller@api_get_user');
Route::post('api_get_provinces', 'API1Controller@api_get_provinces');
Route::post('api_get_amphures', 'API1Controller@api_get_amphures');
Route::post('api_get_districts', 'API1Controller@api_get_districts');
Route::post('api_get_zipcode', 'API1Controller@api_get_zipcode');
Route::post('api_register_store', 'API1Controller@api_register_store');
Route::post('api_change_select_type', 'API1Controller@api_change_select_type');
Route::post('api_forget_password', 'API1Controller@api_forget_password');
Route::post('api_reset_password', 'API1Controller@api_reset_password');
Route::post('api_get_flashsale', 'API1Controller@api_get_flashsale');
Route::post('api_customer_new_address', 'API1Controller@api_customer_new_address');
Route::post('api_get_category', 'API1Controller@api_get_category');
Route::post('api_get_brand', 'API1Controller@api_get_brand');
Route::post('api_get_product_filter', 'API1Controller@api_get_product_filter');
Route::post('api_add_cart', 'API1Controller@api_add_cart');
Route::post('api_get_product_detail', 'API1Controller@api_get_product_detail');
Route::post('api_get_home_page', 'API1Controller@api_get_home_page');
Route::post('api_get_cart_wait', 'API1Controller@api_get_cart_wait');
Route::post('api_get_address_list', 'API1Controller@api_get_address_list');
Route::post('api_select_customer_address', 'API1Controller@api_select_customer_address');
Route::post('api_purchase_cart', 'API1Controller@api_purchase_cart');
Route::post('api_get_order_list', 'API1Controller@api_get_order_list');
Route::post('api_get_product_list', 'API1Controller@api_get_product_list');
Route::post('api_get_store', 'API1Controller@api_get_store');
Route::post('api_get_store_detail', 'API1Controller@api_get_store_detail');
Route::post('api_store_following_update', 'API2Controller@api_store_following_update');

Route::post('api_product_store', 'API1Controller@api_product_store');
Route::post('api_product_store_more', 'API1Controller@api_product_store_more');
Route::post('api_products_transfer_store', 'API1Controller@api_products_transfer_store');
// API2Controller
Route::post('api_products_transfer_approve', 'API2Controller@api_products_transfer_approve');
Route::post('api_get_picking_list', 'API2Controller@api_get_picking_list');
Route::post('api_get_scan_list', 'API2Controller@api_get_scan_list');
Route::post('api_get_shipping_list', 'API2Controller@api_get_shipping_list');
Route::post('api_get_cart_detail', 'API2Controller@api_get_cart_detail');
Route::post('api_pick_update', 'API2Controller@api_pick_update');
Route::post('api_pick_approve', 'API2Controller@api_pick_approve');
Route::post('api_pick_delete', 'API2Controller@api_pick_delete');
Route::post('api_scan_delete', 'API2Controller@api_scan_delete');
Route::post('api_scan_update', 'API2Controller@api_scan_update');
Route::post('api_scan_approve', 'API2Controller@api_scan_approve');
Route::post('api_shipping_approve', 'API2Controller@api_shipping_approve');
Route::post('api_cart_receive', 'API2Controller@api_cart_receive');
Route::post('api_get_customer_cart_product_detail', 'API2Controller@api_get_customer_cart_product_detail');
Route::post('api_tracking_item_update', 'API2Controller@api_tracking_item_update');
Route::post('api_get_order_point_list', 'API2Controller@api_get_order_point_list');
Route::post('api_review_update', 'API2Controller@api_review_update');
Route::post('api_get_store_report', 'API2Controller@api_get_store_report');
Route::post('api_claim_store', 'API2Controller@api_claim_store');
Route::post('api_get_dataset', 'API1Controller@api_get_dataset');
Route::post('api_get_shipping_price', 'API2Controller@api_get_shipping_price');
Route::post('api_pre_cart_purchase', 'API1Controller@api_pre_cart_purchase');
Route::post('api_check_cart_status', 'API1Controller@api_check_cart_status');
Route::post('api_store_update', 'API2Controller@api_store_update');
Route::post('api_get_product_list_category', 'API2Controller@api_get_product_list_category');
Route::post('api_customer_profile_update', 'API1Controller@api_customer_profile_update');
Route::post('api_get_question_ans', 'API2Controller@api_get_question_ans');
Route::post('api_get_web_data', 'API2Controller@api_get_web_data');
Route::post('api_favorite_update', 'API2Controller@api_favorite_update');
Route::post('api_reset_password', 'API2Controller@api_reset_password');
Route::post('api_get_order_list_store', 'API1Controller@api_get_order_list_store');
Route::post('api_get_product_favorite', 'API2Controller@api_get_product_favorite');
Route::post('api_get_order_point_list_store', 'API2Controller@api_get_order_point_list_store');
Route::post('api_get_report_store', 'API2Controller@api_get_report_store');
Route::post('api_get_products_transfer_list', 'API1Controller@api_get_products_transfer_list');
Route::post('api_get_products_transfer_detail', 'API1Controller@api_get_products_transfer_detail');
Route::post('api_get_finance', 'API3Controller@api_get_finance');
Route::get('api_update_finance', 'API3Controller@api_update_finance');

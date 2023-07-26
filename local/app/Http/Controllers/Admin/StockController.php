<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use File;
use Hash;
use App\Models\Store;
use App\Models\Brands;
use App\Models\Products;
Use App\Models\Customer_address;
Use App\Models\Category;
Use App\Models\CustomerCartProduct;
Use App\Models\CustomerCart;
use App\Mail\SendMail;
Use App\Models\ProductsItem;
use Illuminate\Support\Facades\Mail;
Use App\Models\ProductsOptionHead;
Use App\Models\ProductsOption1;
Use App\Models\ProductsOption2;
Use App\Models\ProductsOption2Items;
Use App\Models\ProductsTransfer;
Use App\Models\Stock;
Use App\Models\StockLot;
Use App\Models\StockShelf;
Use App\Models\StockItems;
Use App\Models\StockFloor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
Use App\Models\CustomerCartProductCutStock;
Use App\Models\CustomerCartTracking;

class StockController extends  Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function check_stock(Request $r){
        $stock_lot = StockLot::select('stock_lot.*','products.products_code','products.name_th as product_name')
        ->join('products','products.id','stock_lot.product_id')
        ->orderBy('stock_lot.store_id','asc')
        ->orderBy('stock_lot.product_id','asc')
        ->orderBy('stock_lot.lot_expired_date','asc')
        ->get();
        return view('backend/check-stock',[
            'stock_lots' => $stock_lot
        ]);
    }

    public function order_list(Request $r){
        // $stock_lot = StockLot::select('stock_lot.*','products.products_code','products.name_th as product_name')
        // ->join('products','products.id','stock_lot.product_id')
        // ->orderBy('store_id','asc')
        // ->orderBy('product_id','asc')
        // ->orderBy('lot_expired_date','asc')
        // ->get();
        $customer_cart = CustomerCart::select('customer_cart.*','customer.name as cus_name')
        ->join('customer','customer.id','customer_cart.customer_id')
        ->where('customer_cart.status',2)
        ->orderBy('customer_cart.order_number','desc')
        ->get();

        return view('backend/orders',[
            'customer_cart' => $customer_cart
        ]);
    }

    // public function check_stock(Request $r){
    //     DB::beginTransaction();
    //     try
    //     {
    //             $cart = CustomerCart::where('id',$r->id)->first();
    //             if($cart->picking_status == 1 && $cart->scan_status == 1 && $cart->transfer_status == 1){
    //                 $cart->transfer_status = 2;
    //             }
    //             $cart->save();

    //         DB::commit();

    //         return response()->json([
    //             'message' =>  'สำเร็จ',
    //             'status' => 1,
    //             'data' => [
    //                 // 'cart' => $cart,
    //                 // 'product_cart' => $product_cart,
    //             ],
    //         ]);
    //     }
    //     catch (\Exception $e) {
    //         DB::rollback();
    //         // return $e->getMessage();
    //         return response()->json([
    //             'message' =>  $e->getMessage(),
    //             'status' => 0,
    //             'data' => '',
    //         ]);
    //     }
    //     catch(\FatalThrowableError $e)
    //     {
    //         DB::rollback();
    //         return response()->json([
    //             'message' =>  $e->getMessage(),
    //             'status' => 0,
    //             'data' => '',
    //         ]);
    //     }
    // }

}

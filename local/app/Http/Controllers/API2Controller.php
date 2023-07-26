<?php

namespace App\Http\Controllers;

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

class API2Controller extends  Controller
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

    public function api_products_transfer_approve(Request $r)
    {


        DB::beginTransaction();
        try
            {
                $products_transfer = ProductsTransfer::where('id',$r->products_transfer_id)->first();

                $products_item = ProductsItem::where('id',@$products_transfer->products_item_id)->first();
                if($products_item){
                    $stock = new Stock();
                    $stock->product_id = $products_item->product_id;
                    $stock->store_id = $products_item->store_id;
                    $stock->customer_id = $products_item->customer_id;
                    $stock->save();

                    $stock_lot = new StockLot();
                    $stock_lot->stock_id = $stock->id;
                    $stock_lot->product_id = $products_item->product_id;
                    $stock_lot->store_id = $products_item->store_id;
                    $stock_lot->customer_id = $products_item->customer_id;
                    $stock_lot->date_in_stock = $r->date_in_stock;
                    $stock_lot->lot_expired_date = $r->lot_expired_date;
                    $stock_lot->lot_number = $r->lot_number;
                    $stock_lot->save();

                    $stock_shelf = new StockShelf();
                    $stock_shelf->stock_id = $stock->id;
                    $stock_shelf->stock_lot_id = $stock_lot->id;
                    $stock_shelf->product_id = $products_item->product_id;
                    $stock_shelf->shelf_id = $r->shelf_id;
                    // $stock_shelf->store_id = $products_item->store_id;
                    $stock_shelf->customer_id = $products_item->customer_id;
                    $stock_shelf->name = 'Shelf 1';
                    $stock_shelf->save();

                    $stock_floor = new StockFloor();
                    $stock_floor->stock_shelf_id = $stock_shelf->id;
                    $stock_floor->product_id = $stock_shelf->product_id;
                    $stock_floor->customer_id = $stock_shelf->customer_id;
                    $stock_floor->stock_lot_id = $stock_lot->id;
                    $stock_floor->floor = $r->floor;
                    $stock_floor->save();

                    $products_option_2_items = ProductsOption2Items::where('products_item_id',$products_transfer->products_item_id)
                    ->where('product_id',$products_item->product_id)->get();

                    $products = Products::where('id',$products_item->product_id)->first();
                    $qty = 0;
                    foreach($products_option_2_items as $item){

                        $products_option_1 = ProductsOption1::where('id',$item->option_1_id)->first();
                        $products_option_2 = ProductsOption2::where('id',$item->option_2_id)->first();

                        $stock_items = new StockItems();
                        $stock_items->stock_id = $stock->id;
                        $stock_items->stock_lot_id = $stock_lot->id;
                        $stock_items->stock_shelt_id = $stock_shelf->id;
                        $stock_items->product_id = $products_item->product_id;
                        // $stock_items->store_id = $products_item->store_id;
                        $stock_items->customer_id = $products_item->customer_id;

                        $stock_items->products_option_2_items_id = $item->id;
                        $stock_items->products_item_id = $products_transfer->products_item_id;
                        if($products_option_1->name_th!=''){
                            $stock_items->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
                        }else{
                            $stock_items->name = $products->name_th;
                        }
                        $stock_items->stock_floor_id = $stock_floor->id;
                        $stock_items->qty = $item->qty;
                        $stock_items->qty_booking = $item->qty;
                        $stock_items->price = $item->price;
                        $stock_items->save();
                        $qty += $item->qty;
                    }
                    $products->qty = $products->qty+$qty;
                    $products->approve_status = 1;
                    $products->save();

                    $stock_lot->qty = $qty;
                    $stock_lot->qty_booking = $qty;
                    $stock_lot->save();

                    $products_item->approve_status = 1;
                    $products_item->transfer_status = 3;
                    $products_item->save();

                    $products_transfer->approve_status = 1;
                    $products_transfer->save();


                }else{
                    return response()->json([
                        'message' =>  'ไม่พบข้อมูลสินค้า',
                        'status' => 0,
                        'data' => '',
                    ]);
                }

                DB::commit();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => '',
                ]);

                }
                catch (\Exception $e) {
                    DB::rollback();
                // return $e->getMessage();
                return response()->json([
                    'message' =>  $e->getMessage(),
                    'status' => 0,
                    'data' => '',
                ]);
                }
                catch(\FatalThrowableError $fe)
                {
                    DB::rollback();
                    return response()->json([
                        'message' =>  $e->getMessage(),
                        'status' => 0,
                        'data' => '',
                    ]);
                }
    }

    public static function api_products_transfer_approve_backen($products_transfer_id,$date_in_stock,$lot_expired_date,$lot_number)
    {
          // App\Http\Controllers\API2Controller::api_products_transfer_approve_backen($products_transfer_id,$date_in_stock,$lot_expired_date,$lot_number);


        DB::beginTransaction();
        try
            {
                $products_transfer = ProductsTransfer::where('id',$products_transfer_id)->first();

                $products_item = ProductsItem::where('id',@$products_transfer->products_item_id)->first();
                if($products_item){
                    $stock = new Stock();
                    $stock->product_id = $products_item->product_id;
                    $stock->store_id = $products_item->store_id;
                    $stock->customer_id = $products_item->customer_id;
                    $stock->save();

                    $stock_lot = new StockLot();
                    $stock_lot->stock_id = $stock->id;
                    $stock_lot->product_id = $products_item->product_id;
                    $stock_lot->store_id = $products_item->store_id;
                    $stock_lot->customer_id = $products_item->customer_id;
                    $stock_lot->date_in_stock = $date_in_stock;
                    $stock_lot->lot_expired_date = $lot_expired_date;
                    $stock_lot->lot_number = $lot_number;
                    $stock_lot->save();

                    $stock_shelf = new StockShelf();
                    $stock_shelf->stock_id = $stock->id;
                    $stock_shelf->stock_lot_id = $stock_lot->id;
                    $stock_shelf->product_id = $products_item->product_id;
                    // $stock_shelf->shelf_id = $r->shelf_id;
                    $stock_shelf->shelf_id = '1';
                    $stock_shelf->customer_id = $products_item->customer_id;
                    $stock_shelf->name = 'Shelf 1';
                    $stock_shelf->save();

                    $stock_floor = new StockFloor();
                    $stock_floor->stock_shelf_id = $stock_shelf->id;
                    $stock_floor->product_id = $stock_shelf->product_id;
                    $stock_floor->customer_id = $stock_shelf->customer_id;
                    $stock_floor->stock_lot_id = $stock_lot->id;
                    // $stock_floor->floor = $r->floor;
                    $stock_floor->floor = '1';
                    $stock_floor->save();

                    $products_option_2_items = ProductsOption2Items::where('products_item_id',$products_transfer->products_item_id)
                    ->where('product_id',$products_item->product_id)->get();

                    $products = Products::where('id',$products_item->product_id)->first();
                    $qty = 0;
                    foreach($products_option_2_items as $item){

                        $products_option_1 = ProductsOption1::where('id',$item->option_1_id)->first();
                        $products_option_2 = ProductsOption2::where('id',$item->option_2_id)->first();

                        $stock_items = new StockItems();
                        $stock_items->stock_id = $stock->id;
                        $stock_items->stock_lot_id = $stock_lot->id;
                        $stock_items->stock_shelt_id = $stock_shelf->id;
                        $stock_items->product_id = $products_item->product_id;
                        $stock_items->customer_id = $products_item->customer_id;

                        $stock_items->products_option_2_items_id = $item->id;
                        $stock_items->products_item_id = $products_transfer->products_item_id;
                        if($products_option_1->name_th!=''){
                            $stock_items->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
                        }else{
                            $stock_items->name = $products->name_th;
                        }
                        $stock_items->stock_floor_id = $stock_floor->id;
                        $stock_items->qty = $item->qty;
                        $stock_items->qty_booking = $item->qty;
                        $stock_items->price = $item->price;
                        $stock_items->save();
                        $qty += $item->qty;
                    }
                    $products->qty = $products->qty+$qty;
                    $products->approve_status = 1;
                    $products->save();

                    $stock_lot->qty = $qty;
                    $stock_lot->qty_booking = $qty;
                    $stock_lot->save();

                    $products_item->approve_status = 1;
                    $products_item->transfer_status = 3;
                    $products_item->save();

                    $products_transfer->approve_status = 1;
                    $products_transfer->save();


                }else{
                    return $data=[
                        'message' =>  'ไม่พบข้อมูลสินค้า',
                        'status' => 0,
                        'data' => '',
                    ];
                }

                DB::commit();

                return $data=[
                    'message' =>  'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => '',
                ];

                }
                catch (\Exception $e) {
                    DB::rollback();
                // return $e->getMessage();


                return $data=[
                    'message' =>  $e->getMessage(),
                    'status' => 0,
                    'data' => '',
                ];
                }
                catch(\FatalThrowableError $fe)
                {
                    DB::rollback();
                    return $data=[
                        'message' =>  $e->getMessage(),
                        'status' => 0,
                        'data' => '',
                    ];
                }
    }


    public function api_get_picking_list(Request $r)
    {
        $cart = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',0)->orderBy('shipping_date','asc')->get();
        $cart_success = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->orderBy('shipping_date','asc')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
                    'cart_success' => $cart_success,
                ],
            ]);
    }

    public function api_get_scan_list(Request $r)
    {
        $cart = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->where('scan_status',0)->orderBy('shipping_date','asc')->get();
        $cart_success = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->where('scan_status',1)->orderBy('shipping_date','asc')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
                    'cart_success' => $cart_success,
                ],
            ]);
    }

    public function api_get_shipping_list(Request $r)
    {
        $cart = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->where('scan_status',1)->where('transfer_status',0)->orderBy('shipping_date','asc')->get();
        $cart_success = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->where('scan_status',1)->where('transfer_status',1)->orderBy('shipping_date','asc')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
                    'cart_success' => $cart_success,
                ],
            ]);
    }

    public function api_get_cart_detail(Request $r)
    {
        $cart = CustomerCart::where('id',$r->cart_id)->first();
        $product_qty = 0;
        if($cart){
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products.products_code', 'products.barcode',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)->get();

            $arr_lot = [];
            foreach($products as $index => $pro){
                $product_qty+=$pro->qty;

                // ดึงตำแหน่งสินค้า
                $customer_cart_product_cut_stock = CustomerCartProductCutStock::
                select('customer_cart_product_cut_stock.*','stock_lot.lot_number','dataset_shelf.name as shelf_name','stock_floor.floor','stock_items.name as stock_item_name')
                ->join('stock_items','stock_items.id','customer_cart_product_cut_stock.stock_item_id')
                ->join('stock_floor','stock_floor.id','stock_items.stock_floor_id')
                ->join('stock_shelf','stock_shelf.id','stock_items.stock_shelt_id')
                ->join('dataset_shelf','dataset_shelf.id','stock_shelf.shelf_id')
                ->join('stock_lot','stock_lot.id','stock_shelf.stock_lot_id')
                ->where('customer_cart_product_cut_stock.customer_cart_product_id',$pro->id)
                ->get();

                foreach($customer_cart_product_cut_stock as $key => $c){
                    $arr_lot[$index][$key] = $c->lot_number.' > '.$c->shelf_name.' > '.$c->floor.' > '.$c->stock_item_name;
                }
            }

            $customer_address = Customer_address::
            select('customer_address.*','districts.name_th as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
            ->join('districts','districts.id','customer_address.district_id')
            ->join('amphures','amphures.id','customer_address.amphures_id')
            ->join('provinces','provinces.id','customer_address.province_id')
            ->where('customer_address.id',$cart->customer_address_id)->first();
            if(!$customer_address){
                $customer_address = '';
            }

            $url_img = Storage::disk('public')->url('');

            $tracking_no1 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$r->cart_id)->where('no',1)->first();
            $tracking_no2 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$r->cart_id)->where('no',2)->first();
            $tracking_no3 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$r->cart_id)->where('no',3)->first();
            $tracking_no4 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$r->cart_id)->where('no',4)->first();
            $tracking_no5 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$r->cart_id)->where('no',5)->first();

            $tracking_no1 = ($tracking_no1)? $tracking_no1->tracking_no : '';
            $tracking_no2 = ($tracking_no2)? $tracking_no2->tracking_no : '';
            $tracking_no3 = ($tracking_no3)? $tracking_no3->tracking_no : '';
            $tracking_no4 = ($tracking_no4)? $tracking_no4->tracking_no : '';
            $tracking_no5 = ($tracking_no5)? $tracking_no5->tracking_no : '';

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'product_qty' => $product_qty,
                    'cart' => $cart,
                    'customer_address' => $customer_address,
                    'url_img' => $url_img,
                    'arr_lot' => $arr_lot,
                    'tracking_no1' => $tracking_no1,
                    'tracking_no2' => $tracking_no2,
                    'tracking_no3' => $tracking_no3,
                    'tracking_no4' => $tracking_no4,
                    'tracking_no5' => $tracking_no5,
                ],
            ]);
        }else{
            return response()->json([
                'message' => 'ไม่พบสินค้าในตะกร้า',
                'status' => 0,
                'data' => [
                ],
            ]);
        }
    }

    public function api_pick_update(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('id',$r->id)->first();
                if(($product_cart->pick_qty+1) > $product_cart->qty){
                    return response()->json([
                        'message' =>  'คุณหยิบสินค้าเกินจำนวน',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
                $product_cart->pick_qty = $product_cart->pick_qty+1;
                $product_cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_scan_update(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('id',$r->id)->first();
                $product = Products::select('barcode')->where('id',$product_cart->product_id)->first();
                if($r->barcode != $product->barcode){
                    return response()->json([
                        'message' =>  'Barcode ไม่ตรงกับสินค้าที่เลือก',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
                if(($product_cart->scan_qty+1) > $product_cart->qty){
                    return response()->json([
                        'message' =>  'คุณหยิบสินค้าเกินจำนวน',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
                $product_cart->scan_qty = $product_cart->scan_qty+1;
                $product_cart->save();

            DB::commit();

            if($product_cart->scan_qty == $product_cart->qty){
                return response()->json([
                    'message' =>  'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        'qty_status' => 'full'
                    ],
                ]);
            }else{
                return response()->json([
                    'message' =>  'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        'qty_status' => 'wait'
                    ],
                ]);
            }


        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }


    public function api_pick_delete(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('id',$r->id)->first();
                if($product_cart->pick_qty>0){
                    $product_cart->pick_qty = $product_cart->pick_qty-1;
                }
                $product_cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_scan_delete(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('id',$r->id)->first();
                if($product_cart->scan_qty>0){
                    $product_cart->scan_qty = $product_cart->scan_qty-1;
                }
                $product_cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_pick_approve(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('customer_cart_id',$r->id)->get();
                $fail = 0;
                foreach($product_cart as $p){
                    if($p->qty > $p->pick_qty){
                        $fail++;
                    }
                }
                if($fail > 0){
                    return response()->json([
                        'message' =>  'กรุณาหยิบสินค้าให้ครบถ้วนก่อนทำรายการ',
                        'status' => 0,
                        'data' => '',
                    ]);
                }

                $cart = CustomerCart::where('id',$r->id)->first();
                $cart->picking_status = 1;
                $cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_scan_approve(Request $r){
        DB::beginTransaction();
        try
        {
                $product_cart = CustomerCartProduct::where('customer_cart_id',$r->id)->get();
                $fail = 0;
                foreach($product_cart as $p){
                    if($p->qty > $p->scan_qty){
                        $fail++;
                    }
                }
                if($fail > 0){
                    return response()->json([
                        'message' =>  'กรุณาสแกนสินค้าให้ครบถ้วนก่อนทำรายการ',
                        'status' => 0,
                        'data' => '',
                    ]);
                }

                foreach($product_cart as $p){

                $customer_cart_product_cut_stock = CustomerCartProductCutStock::
                select('customer_cart_product_cut_stock.*','stock_lot.lot_number','dataset_shelf.name as shelf_name','stock_floor.floor','stock_items.name as stock_item_name')
                ->join('stock_items','stock_items.id','customer_cart_product_cut_stock.stock_item_id')
                ->join('stock_floor','stock_floor.id','stock_items.stock_floor_id')
                ->join('stock_shelf','stock_shelf.id','stock_items.stock_shelt_id')
                ->join('dataset_shelf','dataset_shelf.id','stock_shelf.shelf_id')
                ->join('stock_lot','stock_lot.id','stock_shelf.stock_lot_id')
                ->where('customer_cart_product_cut_stock.customer_cart_product_id',$p->id)
                ->get();

                foreach($customer_cart_product_cut_stock as $key => $c){
                    // $arr_lot[$index][$key] = $c->lot_number.' > '.$c->shelf_name.' > '.$c->floor.' > '.$c->stock_item_name;
                    $stock_items = StockItems::where('id',$c->stock_item_id)->first();
                    $stock_items->qty = ($stock_items->qty - $c->qty_has);
                    $stock_items->save();

                    $stock_lot = StockLot::where('id',$c->stock_lot_id)->first();
                    $stock_lot->qty = ($stock_lot->qty - $c->qty_has);
                    $stock_lot->save();
                }
            }

                $cart = CustomerCart::where('id',$r->id)->first();
                $cart->scan_status = 1;
                $cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_shipping_approve(Request $r){
        DB::beginTransaction();
        try
        {

                $cart = CustomerCart::where('id',$r->id)->first();
                if($cart->picking_status == 1 && $cart->scan_status == 1){
                    $cart->transfer_status = 1;
                }
                $cart->save();

                if($r->tracking_no1 != ''){
                    $tracking_no1 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',1)->first();
                    if(!$tracking_no1){
                        $tracking_no1 = new CustomerCartTracking();
                    }
                    $tracking_no1->customer_cart_id = $cart->id;
                    $tracking_no1->customer_id = $cart->customer_id;
                    $tracking_no1->tracking_no = $r->tracking_no1;
                    $tracking_no1->transfer_type = 1;
                    $tracking_no1->cod = 0;
                    $tracking_no1->no = 1;
                    $tracking_no1->save();
                }

                if($r->tracking_no2 != ''){
                    $tracking_no1 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',2)->first();
                    if(!$tracking_no2){
                        $tracking_no2 = new CustomerCartTracking();
                    }
                    $tracking_no2->customer_cart_id = $cart->id;
                    $tracking_no2->customer_id = $cart->customer_id;
                    $tracking_no2->tracking_no = $r->tracking_no2;
                    $tracking_no2->transfer_type = 1;
                    $tracking_no2->cod = 0;
                    $tracking_no2->no = 2;
                    $tracking_no2->save();
                }

                if($r->tracking_no3 != ''){
                    $tracking_no3 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',3)->first();
                    if(!$tracking_no3){
                        $tracking_no3 = new CustomerCartTracking();
                    }
                    $tracking_no3->customer_cart_id = $cart->id;
                    $tracking_no3->customer_id = $cart->customer_id;
                    $tracking_no3->tracking_no = $r->tracking_no3;
                    $tracking_no3->transfer_type = 1;
                    $tracking_no3->cod = 0;
                    $tracking_no3->no = 3;
                    $tracking_no3->save();
                }

                if($r->tracking_no4 != ''){
                    $tracking_no4 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',4)->first();
                    if(!$tracking_no4){
                        $tracking_no4 = new CustomerCartTracking();
                    }
                    $tracking_no4->customer_cart_id = $cart->id;
                    $tracking_no4->customer_id = $cart->customer_id;
                    $tracking_no4->tracking_no = $r->tracking_no4;
                    $tracking_no4->transfer_type = 1;
                    $tracking_no4->cod = 0;
                    $tracking_no4->no = 4;
                    $track4g_no1->save();
                }

                if($r->tracking_no5 != ''){
                    $tracking_no5 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',5)->first();
                    if(!$tracking_no5){
                        $tracking_no5 = new CustomerCartTracking();
                    }
                    $tracking_no5->customer_cart_id = $cart->id;
                    $tracking_no5->customer_id = $cart->customer_id;
                    $tracking_no5->tracking_no = $r->tracking_no5;
                    $tracking_no5->transfer_type = 1;
                    $tracking_no5->cod = 0;
                    $tracking_no5->no = 5;
                    $tracking_no1->save();
                }

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_cart_reciept(Request $r){
        DB::beginTransaction();
        try
        {
                $cart = CustomerCart::where('id',$r->id)->first();
                if($cart->picking_status == 1 && $cart->scan_status == 1 && $cart->transfer_status == 1){
                    $cart->transfer_status = 2;
                }
                $cart->save();

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    // 'cart' => $cart,
                    // 'product_cart' => $product_cart,
                ],
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
        catch(\FatalThrowableError $e)
        {
            DB::rollback();
            return response()->json([
                'message' =>  $e->getMessage(),
                'status' => 0,
                'data' => '',
            ]);
        }
    }

}

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
Use App\Models\CustomerCartTrackingItem;
Use App\Models\ProductsComment;
Use App\Models\CustomerCartClaim;

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

                    $shelf = DB::table('dataset_shelf')->where('id',$r->shelf_id)->first();

                    $stock_shelf = new StockShelf();
                    $stock_shelf->stock_id = $stock->id;
                    $stock_shelf->stock_lot_id = $stock_lot->id;
                    $stock_shelf->product_id = $products_item->product_id;
                    $stock_shelf->shelf_id = $r->shelf_id;
                    // $stock_shelf->store_id = $products_item->store_id;
                    $stock_shelf->customer_id = $products_item->customer_id;
                    $stock_shelf->name = $shelf->name;
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


    public static function api_products_transfer_approve_back($products_transfer_id,$date_in_stock,$lot_expired_date,$lot_number,$shelf_id,$floor)
    {


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

                    $shelf = DB::table('dataset_shelf')->where('id',$shelf_id)->first();


                    $stock_shelf = new StockShelf();
                    $stock_shelf->stock_id = $stock->id;
                    $stock_shelf->stock_lot_id = $stock_lot->id;
                    $stock_shelf->product_id = $products_item->product_id;
                    $stock_shelf->shelf_id = $shelf_id;
                    // $stock_shelf->store_id = $products_item->store_id;
                    $stock_shelf->customer_id = $products_item->customer_id;
                    $stock_shelf->name = $shelf->name;


                    $stock_shelf->save();


                    $stock_floor = new StockFloor();
                    $stock_floor->stock_shelf_id = $stock_shelf->id;
                    $stock_floor->product_id = $stock_shelf->product_id;
                    $stock_floor->customer_id = $stock_shelf->customer_id;
                    $stock_floor->stock_lot_id = $stock_lot->id;
                    $stock_floor->floor = $floor;
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
                    return $data = [
                        'message' =>  'ไม่พบข้อมูลสินค้า',
                        'status' => 0,
                        'data' => '',
                    ];
                }

                DB::commit();
                return $data = [
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => '',
                ];

                }
                catch (\Exception $e) {
                    DB::rollback();
                // return $e->getMessage();
                return $data = [
                    'message' =>  $e->getMessage(),
                    'status' => 0,
                    'data' => '',
                ];
                }
                catch(\FatalThrowableError $e)
                {
                    DB::rollback();
                    return $data = [
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
        $cart = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
        ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
        ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
        ->where('customer_cart.id',$r->cart_id)->first();
        $product_qty = 0;
        if($cart){
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products_gallery.path as gal_path','products_gallery.name as gal_name',
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

    public static function api_get_cart_detail_web($cart_id)
    {
        $cart = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
        ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
        ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
        ->where('customer_cart.id',$cart_id)->first();
        $product_qty = 0;
        if($cart){
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products_gallery.path as gal_path','products_gallery.name as gal_name',
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

            $tracking_no1 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$cart_id)->where('no',1)->first();
            $tracking_no2 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$cart_id)->where('no',2)->first();
            $tracking_no3 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$cart_id)->where('no',3)->first();
            $tracking_no4 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$cart_id)->where('no',4)->first();
            $tracking_no5 = CustomerCartTracking::select('tracking_no')->where('customer_cart_id',$cart_id)->where('no',5)->first();

            $tracking_no1 = ($tracking_no1)? $tracking_no1->tracking_no : '';
            $tracking_no2 = ($tracking_no2)? $tracking_no2->tracking_no : '';
            $tracking_no3 = ($tracking_no3)? $tracking_no3->tracking_no : '';
            $tracking_no4 = ($tracking_no4)? $tracking_no4->tracking_no : '';
            $tracking_no5 = ($tracking_no5)? $tracking_no5->tracking_no : '';

            return $data = [
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
                ]];
        }else{
            return $data = [
                'message' => 'ไม่พบสินค้าในตะกร้า',
                'status' => 0,
                'data' => [
                ]];
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
                // $product_cart = CustomerCartProduct::where('id',$r->id)->first();
                // $product = Products::select('barcode')->where('id',$product_cart->product_id)->first();
                $product = Products::select('barcode','id')->where('barcode',$r->barcode)->first();
                if($product){
                    $product_cart = CustomerCartProduct::where('customer_cart_id',$r->id)->where('product_id',$product->id)->first();
                    if($product_cart){
                        if(($product_cart->scan_qty+1) > $product_cart->qty){
                            return response()->json([
                                'message' =>  'คุณหยิบสินค้าเกินจำนวน',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                        $product_cart->scan_qty = $product_cart->scan_qty+1;
                        $product_cart->save();
                    }else{
                        return response()->json([
                            'message' =>  'Barcode ไม่ตรงกับสินค้าที่เลือกในออเดอร์',
                            'status' => 0,
                            'data' => '',
                        ]);
                    }


                }else{
                        return response()->json([
                            'message' =>  'Barcode ไม่ตรงกับสินค้าที่เลือก',
                            'status' => 0,
                            'data' => '',
                        ]);
                }

            DB::commit();

            // if($product_cart->scan_qty == $product_cart->qty){
            //     return response()->json([
            //         'message' =>  'สำเร็จ',
            //         'status' => 1,
            //         'data' => [
            //             'qty_status' => 'full'
            //         ],
            //     ]);
            // }else{
                return response()->json([
                    'message' =>  'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        'qty_status' => 'wait'
                    ],
                ]);
            // }


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

                    $tracking_no1 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',1)->first();
                    if(!$tracking_no1){
                        $tracking_no1 = new CustomerCartTracking();
                    }
                    $tracking_no1->customer_cart_id = $cart->id;
                    $tracking_no1->customer_id = $cart->customer_id;
                    $tracking_no1->tracking_no = '';
                    $tracking_no1->transfer_type = 1;
                    $tracking_no1->cod = 0;
                    $tracking_no1->no = 1;
                    $tracking_no1->save();

                $customer_cart_product = CustomerCartProduct::Where('customer_cart_id',$cart->id)->get();
                CustomerCartTrackingItem::where('customer_cart_id',$cart->id)->delete();
                foreach($customer_cart_product as $c){
                    $customer_cart_tracking_item = new CustomerCartTrackingItem();
                    $customer_cart_tracking_item->customer_cart_id = $cart->id;
                    $customer_cart_tracking_item->customer_id = $cart->customer_id;
                    $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no1->id;
                    $customer_cart_tracking_item->customer_cart_product_id = $c->id;
                    $customer_cart_tracking_item->qty = $c->qty;
                    $customer_cart_tracking_item->save();
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

    public function api_get_customer_cart_product_detail(Request $r)
    {
            $customer_cart_product = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products.products_code', 'products.barcode',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.id',$r->customer_cart_product_id)->first();

            if($customer_cart_product){
                $url_img = Storage::disk('public')->url('');

                $tracking_no1_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',1)->first();
                $tracking_no2_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',2)->first();
                $tracking_no3_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',3)->first();
                $tracking_no4_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',4)->first();
                $tracking_no5_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',5)->first();

                $tracking_no1 = ($tracking_no1_data)? $tracking_no1_data->tracking_no : '';
                $tracking_no2 = ($tracking_no2_data)? $tracking_no2_data->tracking_no : '';
                $tracking_no3 = ($tracking_no3_data)? $tracking_no3_data->tracking_no : '';
                $tracking_no4 = ($tracking_no4_data)? $tracking_no4_data->tracking_no : '';
                $tracking_no5 = ($tracking_no5_data)? $tracking_no5_data->tracking_no : '';

                if($tracking_no1_data){
                    $customer_cart_tracking_item_no1 = CustomerCartTrackingItem::select('qty')->where('customer_cart_tracking_id',$tracking_no1_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                    $tracking_no1_qty = $customer_cart_tracking_item_no1->qty;
                }else{
                    $tracking_no1_qty = '';
                }

                if($tracking_no2_data){
                    $customer_cart_tracking_item_no2 = CustomerCartTrackingItem::select('qty')->where('customer_cart_tracking_id',$tracking_no2_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                    if(!$customer_cart_tracking_item_no2){
                        $customer_cart_tracking_item_no2 = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item_no2->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item_no2->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item_no2->customer_cart_tracking_id = $tracking_no2_data->id;
                        $customer_cart_tracking_item_no2->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item_no2->qty = 0;
                        $customer_cart_tracking_item_no2->save();
                    }
                    $tracking_no2_qty = $customer_cart_tracking_item_no2->qty;
                }else{
                    $tracking_no2_qty = '';
                }

                if($tracking_no3_data){
                    $customer_cart_tracking_item_no3 = CustomerCartTrackingItem::select('qty')->where('customer_cart_tracking_id',$tracking_no3_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                    if(!$customer_cart_tracking_item_no3){
                        $customer_cart_tracking_item_no3 = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item_no3->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item_no3->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item_no3->customer_cart_tracking_id = $tracking_no3_data->id;
                        $customer_cart_tracking_item_no3->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item_no3->qty = 0;
                        $customer_cart_tracking_item_no3->save();
                    }
                    $tracking_no3_qty = $customer_cart_tracking_item_no3->qty;
                }else{
                    $tracking_no3_qty = '';
                }

                if($tracking_no4_data){
                    $customer_cart_tracking_item_no4 = CustomerCartTrackingItem::select('qty')->where('customer_cart_tracking_id',$tracking_no4_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                    if(!$customer_cart_tracking_item_no4){
                        $customer_cart_tracking_item_no4 = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item_no4->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item_no4->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item_no4->customer_cart_tracking_id = $tracking_no4_data->id;
                        $customer_cart_tracking_item_no4->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item_no4->qty = 0;
                        $customer_cart_tracking_item_no4->save();
                    }
                    $tracking_no4_qty = $customer_cart_tracking_item_no4->qty;
                }else{
                    $tracking_no4_qty = '';
                }

                if($tracking_no5_data){
                    $customer_cart_tracking_item_no5 = CustomerCartTrackingItem::select('qty')->where('customer_cart_tracking_id',$tracking_no5_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                    if(!$customer_cart_tracking_item_no5){
                        $customer_cart_tracking_item_no5 = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item_no5->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item_no5->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item_no5->customer_cart_tracking_id = $tracking_no5_data->id;
                        $customer_cart_tracking_item_no5->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item_no5->qty = 0;
                        $customer_cart_tracking_item_no5->save();
                    }
                    $tracking_no5_qty = $customer_cart_tracking_item_no5->qty;
                }else{
                    $tracking_no5_qty = '';
                }

                return response()->json([
                    'message' => 'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        'customer_cart_product' => $customer_cart_product,
                        'url_img' => $url_img,
                        'tracking_no1' => $tracking_no1,
                        'tracking_no2' => $tracking_no2,
                        'tracking_no3' => $tracking_no3,
                        'tracking_no4' => $tracking_no4,
                        'tracking_no5' => $tracking_no5,

                        'tracking_no1_qty' => $tracking_no1_qty,
                        'tracking_no2_qty' => $tracking_no2_qty,
                        'tracking_no3_qty' => $tracking_no3_qty,
                        'tracking_no4_qty' => $tracking_no4_qty,
                        'tracking_no5_qty' => $tracking_no5_qty,
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

    public function api_tracking_item_update(Request $r)
    {

            $customer_cart_product = CustomerCartProduct::select('customer_cart_product.id','customer_cart_product.customer_cart_id','customer_cart_product.qty','customer_cart_product.customer_id')
            ->where('customer_cart_product.id',$r->customer_cart_product_id)->first();
            $url_img = Storage::disk('public')->url('');

            if($customer_cart_product){

                DB::beginTransaction();
                try
                {

                $tracking_no1_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',1)->first();
                $tracking_no2_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',2)->first();
                $tracking_no3_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',3)->first();
                $tracking_no4_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',4)->first();
                $tracking_no5_data = CustomerCartTracking::select('tracking_no','id')->where('customer_cart_id',$customer_cart_product->customer_cart_id)->where('no',5)->first();
                $qty_total = 0;

                if($r->tracking_no1_qty!=''){
                    if($tracking_no1_data){
                        $customer_cart_tracking_item = CustomerCartTrackingItem::where('customer_cart_tracking_id',$tracking_no1_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                        $customer_cart_tracking_item->qty = $r->tracking_no1_qty;
                        $customer_cart_tracking_item->save();
                    }else{
                        $tracking_no1_data = new CustomerCartTracking();
                        $tracking_no1_data->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $tracking_no1_data->customer_id = $customer_cart_product->customer_id;
                        $tracking_no1_data->tracking_no = '';
                        $tracking_no1_data->transfer_type = 1;
                        $tracking_no1_data->cod = 0;
                        $tracking_no1_data->no = 1;
                        $tracking_no1_data->save();

                        $customer_cart_tracking_item = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no1_data->id;
                        $customer_cart_tracking_item->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item->qty = $r->tracking_no1_qty;
                        $customer_cart_tracking_item->save();
                    }
                    $qty_total += $r->tracking_no1_qty;
                }

                if($r->tracking_no2_qty!=''){
                    if($tracking_no2_data){
                        $customer_cart_tracking_item = CustomerCartTrackingItem::where('customer_cart_tracking_id',$tracking_no2_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                        $customer_cart_tracking_item->qty = $r->tracking_no2_qty;
                        $customer_cart_tracking_item->save();
                    }else{
                        $tracking_no2_data = new CustomerCartTracking();
                        $tracking_no2_data->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $tracking_no2_data->customer_id = $customer_cart_product->customer_id;
                        $tracking_no2_data->tracking_no = '';
                        $tracking_no2_data->transfer_type = 1;
                        $tracking_no2_data->cod = 0;
                        $tracking_no2_data->no = 2;
                        $tracking_no2_data->save();

                        $customer_cart_tracking_item = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no2_data->id;
                        $customer_cart_tracking_item->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item->qty = $r->tracking_no2_qty;
                        $customer_cart_tracking_item->save();
                    }
                    $qty_total += $r->tracking_no2_qty;
                }

                if($r->tracking_no3_qty!=''){
                    if($tracking_no3_data){
                        $customer_cart_tracking_item = CustomerCartTrackingItem::where('customer_cart_tracking_id',$tracking_no3_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                        $customer_cart_tracking_item->qty = $r->tracking_no3_qty;
                        $customer_cart_tracking_item->save();
                    }else{
                        $tracking_no3_data = new CustomerCartTracking();
                        $tracking_no3_data->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $tracking_no3_data->customer_id = $customer_cart_product->customer_id;
                        $tracking_no3_data->tracking_no = '';
                        $tracking_no3_data->transfer_type = 1;
                        $tracking_no3_data->cod = 0;
                        $tracking_no3_data->no = 3;
                        $tracking_no3_data->save();

                        $customer_cart_tracking_item = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no3_data->id;
                        $customer_cart_tracking_item->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item->qty = $r->tracking_no3_qty;
                        $customer_cart_tracking_item->save();
                    }
                    $qty_total += $r->tracking_no3_qty;
                }

                if($r->tracking_no4_qty!=''){
                    if($tracking_no4_data){
                        $customer_cart_tracking_item = CustomerCartTrackingItem::where('customer_cart_tracking_id',$tracking_no4_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                        $customer_cart_tracking_item->qty = $r->tracking_no4_qty;
                        $customer_cart_tracking_item->save();
                    }else{
                        $tracking_no4_data = new CustomerCartTracking();
                        $tracking_no4_data->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $tracking_no4_data->customer_id = $customer_cart_product->customer_id;
                        $tracking_no4_data->tracking_no = '';
                        $tracking_no4_data->transfer_type = 1;
                        $tracking_no4_data->cod = 0;
                        $tracking_no4_data->no = 4;
                        $tracking_no4_data->save();

                        $customer_cart_tracking_item = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no4_data->id;
                        $customer_cart_tracking_item->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item->qty = $r->tracking_no4_qty;
                        $customer_cart_tracking_item->save();
                    }
                    $qty_total += $r->tracking_no4_qty;
                }

                if($r->tracking_no5_qty!=''){
                    if($tracking_no5_data){
                        $customer_cart_tracking_item = CustomerCartTrackingItem::where('customer_cart_tracking_id',$tracking_no5_data->id)->where('customer_cart_product_id',$customer_cart_product->id)->first();
                        $customer_cart_tracking_item->qty = $r->tracking_no5_qty;
                        $customer_cart_tracking_item->save();
                    }else{
                        $tracking_no5_data = new CustomerCartTracking();
                        $tracking_no5_data->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $tracking_no5_data->customer_id = $customer_cart_product->customer_id;
                        $tracking_no5_data->tracking_no = '';
                        $tracking_no5_data->transfer_type = 1;
                        $tracking_no5_data->cod = 0;
                        $tracking_no5_data->no = 5;
                        $tracking_no5_data->save();

                        $customer_cart_tracking_item = new CustomerCartTrackingItem();
                        $customer_cart_tracking_item->customer_cart_id = $customer_cart_product->customer_cart_id;
                        $customer_cart_tracking_item->customer_id = $customer_cart_product->customer_id;
                        $customer_cart_tracking_item->customer_cart_tracking_id = $tracking_no5_data->id;
                        $customer_cart_tracking_item->customer_cart_product_id = $customer_cart_product->id;
                        $customer_cart_tracking_item->qty = $r->tracking_no5_qty;
                        $customer_cart_tracking_item->save();
                    }
                    $qty_total += $r->tracking_no5_qty;
                }

                if($qty_total != $customer_cart_product->qty){
                    return response()->json([
                        'message' =>  'จำนวนยอดสินค้าไม่พอดี',
                        'status' => 0,
                        'data' => '',
                    ]);
                }

                DB::commit();
                return response()->json([
                    'message' => 'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        'customer_cart_product' => $customer_cart_product,
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

        }else{
            return response()->json([
                'message' => 'ไม่พบสินค้าในตะกร้า',
                'status' => 0,
                'data' => [
                ],
            ]);
        }
    }

    public function api_get_order_point_list(Request $r)
    {
        $cart = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
        ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
        ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
        ->where('customer_cart.id',$r->cart_id)->first();
        $product_qty = 0;
        if($cart){
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products_gallery.path as gal_path','products_gallery.name as gal_name',
            'customer.name as cus_name',
            'products.products_code', 'products.barcode',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('customer','customer.id','customer_cart_product.customer_id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)
            ->where('customer_cart_product.rate_status',0)
            ->get();

            $products_success = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'products_gallery.path as img_path','products_gallery.name as img_name',
            'products_gallery.path as gal_path','products_gallery.name as gal_name',
            'customer.name as cus_name',
            'products.products_code',
            'products.barcode',
            'products_comment.show_name',
            'products_comment.comment_date',
            'products_comment.detail as comment_detail',
            'products_comment.rate as comment_rate',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('customer','customer.id','customer_cart_product.customer_id')
            ->join('products_comment','products_comment.customer_cart_product_id','customer_cart_product.id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)
            ->where('customer_cart_product.rate_status',1)
            ->get();

            $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'products_success' => $products_success,
                    'product_qty' => $product_qty,
                    'cart' => $cart,
                    'url_img' => $url_img,
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

    public function api_review_update(Request $r)
    {
      DB::beginTransaction();
                try
                {

                    $customer_cart_product = CustomerCartProduct::where('id',$r->customer_cart_product_id)->first();
                    $customer_cart_product->rate_status = 1;

                    $products_comment = new ProductsComment();
                    $products_comment->product_id = $customer_cart_product->product_id;
                    $products_comment->customer_id = $customer_cart_product->customer_id;
                    $products_comment->customer_cart_product_id = $customer_cart_product->id;
                    $products_comment->rate = $r->rate;
                    $products_comment->detail = $r->detail;
                    $products_comment->comment_date = date('Y-m-d');

                    if($r->show_name == 'true'){
                        $r->show_name = 1;
                    }else{
                        $r->show_name = 0;
                    }

                    $products_comment->show_name = $r->show_name;
                    $products_comment->save();

                    $products_comment_arr = ProductsComment::select('rate')->where('product_id',$customer_cart_product->product_id)->pluck('rate')->toArray();

                    $rate = array_sum($products_comment_arr)/count($products_comment_arr);

                    $product = Products::where('id',$customer_cart_product->product_id)->first();
                    $product->rate = $rate;
                    $product->save();

                    $customer_cart_product->rate = $r->rate;
                    $customer_cart_product->save();

                 DB::commit();
                return response()->json([
                    'message' => 'สำเร็จ',
                    'status' => 1,
                    'data' => [
                        // 'customer_cart_product' => $customer_cart_product,
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

        public function api_get_store_report(Request $r)
        {
            $store = Store::where('customerr_id',$r->customerr_id)->first();


            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'store' => $store,
                ],
            ]);
        }

        public function api_claim_store(Request $r)
        {
            DB::beginTransaction();
            try
                {

                    $CustomerCart = CustomerCart::where('id',$r->customer_cart_id)->first();
                    $CustomerCartProduct = CustomerCartProduct::where('customer_cart_id',$r->customer_cart_id)->first();
                    $product = Products::where('id',$CustomerCartProduct->product_id)->first();


                    $cart_claim = new CustomerCartClaim();
                    $cart_claim->customer_cart_id = $r->customer_cart_id;
                    $cart_claim->customer_id = $CustomerCart->customer_id;

                    $cart_claim->store_id = $product->store_id;
                    $cart_claim->problem_id = $r->problem_id;
                    $cart_claim->other_problem = $r->other_problem;

                        $gal = explode('|',$r->images);
                        foreach ($gal as $key => $img) {
                            if($img!=''){
                                $image_64 = $img;
                                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                                 // find substring fro replace here eg: data:image/png;base64,
                                $image = str_replace($replace, '', $image_64);
                                $image = str_replace(' ', '+', $image);
                                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                                Storage::disk('public')->put('order/'.$CustomerCart->customer_id.'/'.$CustomerCart->id.'/' . $imageName, base64_decode($image));
                                // Storage::delete('file_payment/' . $check->file_slip);

                                if($key+1 == 1){
                                    $cart_claim->img1 = $imageName;
                                }
                                if($key+1 == 2){
                                    $cart_claim->img2 = $imageName;
                                }
                                if($key+1 == 3){
                                    $cart_claim->img3 = $imageName;
                                }

                            }

                            $cart_claim->img_path = 'order/'.$CustomerCart->customer_id.'/'.$CustomerCart->id.'/';
                            $cart_claim->save();

                            $CustomerCart->claim_status = 1;
                            $CustomerCart->save();

                    }

                    DB::commit();
                    return response()->json([
                        'message' => 'บันทึกสำเร็จ กรุณารอการตรวจสอบ',
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

}

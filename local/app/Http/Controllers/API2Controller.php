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
Use App\Models\FinanceMovement;
Use App\Models\CustomerCartAddress;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Filesystem\Filesystem;
use App\Models\StockPre;
use App\Models\StockItemsPre;
use App\Models\StockLotPre;

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

    // public function api_products_transfer_approve(Request $r)
    // {

    //     DB::beginTransaction();
    //     try
    //         {
    //             $products_transfer = ProductsTransfer::where('id',$r->products_transfer_id)->first();

    //             $products_item = ProductsItem::where('id',@$products_transfer->products_item_id)->first();
    //             if($products_item){
    //                 $stock = new Stock();
    //                 $stock->product_id = $products_item->product_id;
    //                 $stock->store_id = $products_item->store_id;
    //                 $stock->customer_id = $products_item->customer_id;
    //                 $stock->save();

    //                 $stock_lot = new StockLot();
    //                 $stock_lot->stock_id = $stock->id;
    //                 $stock_lot->product_id = $products_item->product_id;
    //                 $stock_lot->store_id = $products_item->store_id;
    //                 $stock_lot->customer_id = $products_item->customer_id;
    //                 $stock_lot->date_in_stock = $r->date_in_stock;
    //                 $stock_lot->lot_expired_date = $r->lot_expired_date;
    //                 $stock_lot->lot_number = $r->lot_number;
    //                 $stock_lot->save();

    //                 $shelf = DB::table('dataset_shelf')->where('id',$r->shelf_id)->first();

    //                 $stock_shelf = new StockShelf();
    //                 $stock_shelf->stock_id = $stock->id;
    //                 $stock_shelf->stock_lot_id = $stock_lot->id;
    //                 $stock_shelf->product_id = $products_item->product_id;
    //                 $stock_shelf->shelf_id = $r->shelf_id;
    //                 // $stock_shelf->store_id = $products_item->store_id;
    //                 $stock_shelf->customer_id = $products_item->customer_id;
    //                 $stock_shelf->name = $shelf->name;
    //                 $stock_shelf->save();

    //                 $stock_floor = new StockFloor();
    //                 $stock_floor->stock_shelf_id = $stock_shelf->id;
    //                 $stock_floor->product_id = $stock_shelf->product_id;
    //                 $stock_floor->customer_id = $stock_shelf->customer_id;
    //                 $stock_floor->stock_lot_id = $stock_lot->id;
    //                 $stock_floor->floor = $r->floor;
    //                 $stock_floor->save();

    //                 $products_option_2_items = ProductsOption2Items::where('products_item_id',$products_transfer->products_item_id)
    //                 ->where('product_id',$products_item->product_id)->get();

    //                 $products = Products::where('id',$products_item->product_id)->first();
    //                 $qty = 0;
    //                 foreach($products_option_2_items as $item){

    //                     $products_option_1 = ProductsOption1::where('id',$item->option_1_id)->first();
    //                     $products_option_2 = ProductsOption2::where('id',$item->option_2_id)->first();

    //                     $stock_items = new StockItems();
    //                     $stock_items->stock_id = $stock->id;
    //                     $stock_items->stock_lot_id = $stock_lot->id;
    //                     $stock_items->stock_shelt_id = $stock_shelf->id;
    //                     $stock_items->product_id = $products_item->product_id;
    //                     // $stock_items->store_id = $products_item->store_id;
    //                     $stock_items->customer_id = $products_item->customer_id;

    //                     $stock_items->products_option_2_items_id = $item->id;
    //                     $stock_items->products_item_id = $products_transfer->products_item_id;
    //                     if($products_option_1->name_th!=''){
    //                         $stock_items->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
    //                     }else{
    //                         $stock_items->name = $products->name_th;
    //                     }
    //                     $stock_items->stock_floor_id = $stock_floor->id;
    //                     $stock_items->qty = $item->qty;
    //                     $stock_items->qty_booking = $item->qty;
    //                     $stock_items->price = $item->price;
    //                     $stock_items->save();
    //                     $qty += $item->qty;
    //                 }
    //                 $products->qty = $products->qty+$qty;
    //                 $products->approve_status = 1;
    //                 $products->save();

    //                 $stock_lot->qty = $qty;
    //                 $stock_lot->qty_booking = $qty;
    //                 $stock_lot->save();

    //                 $products_item->approve_status = 1;
    //                 $products_item->transfer_status = 3;
    //                 $products_item->save();

    //                 $products_transfer->approve_status = 1;
    //                 $products_transfer->save();


    //             }else{
    //                 return response()->json([
    //                     'message' =>  'ไม่พบข้อมูลสินค้า',
    //                     'status' => 0,
    //                     'data' => '',
    //                 ]);
    //             }

    //             DB::commit();
    //             return response()->json([
    //                 'message' => 'ทำรายการสำเร็จ',
    //                 'status' => 1,
    //                 'data' => '',
    //             ]);

    //             }
    //             catch (\Exception $e) {
    //                 DB::rollback();
    //             // return $e->getMessage();
    //             return response()->json([
    //                 'message' =>  $e->getMessage(),
    //                 'status' => 0,
    //                 'data' => '',
    //             ]);
    //             }
    //             catch(\FatalThrowableError $e)
    //             {
    //                 DB::rollback();
    //                 return response()->json([
    //                     'message' =>  $e->getMessage(),
    //                     'status' => 0,
    //                     'data' => '',
    //                 ]);
    //             }
    // }

    // รับสินค้า
    public static function api_products_transfer_approve_back($products_transfer_id,$date_in_stock,$lot_expired_date,$lot_number,$shelf_id,$floor,$r,$qty_new)
    {
        DB::beginTransaction();
        try
            {
                $products_transfer = ProductsTransfer::where('id',$products_transfer_id)->first();
                // if($products_transfer->is_preorder == 0){
                    $products_item = ProductsItem::where('id',@$products_transfer->products_item_id)->first();
                    if($products_item){
                        $stock = Stock::where('product_id',$products_item->product_id)->where('store_id',$products_item->store_id)
                        ->where('customer_id',$products_item->customer_id)->first();
                        if(!$stock){
                            $stock = new Stock();
                            $stock->product_id = $products_item->product_id;
                            $stock->store_id = $products_item->store_id;
                            $stock->customer_id = $products_item->customer_id;
                            $stock->save();
                        }

                        $stock_lot = new StockLot();
                        $stock_lot->stock_id = $stock->id;
                        $stock_lot->product_id = $products_item->product_id;
                        $stock_lot->store_id = $products_item->store_id;
                        $stock_lot->customer_id = $products_item->customer_id;
                        $stock_lot->date_in_stock = $date_in_stock;
                        $stock_lot->lot_expired_date = $lot_expired_date;
                        $stock_lot->product_expired_date = date('Y-m-d', strtotime($products_item->production_date. ' + '.($products_item->shelf_lift).' days'));
                        $stock_lot->products_item_id = $products_item->id;
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

                        if($products_transfer->is_preorder == 0){
                            $products_option_2_items = ProductsOption2Items::where('products_item_id',$products_transfer->products_item_id)
                            ->where('product_id',$products_item->product_id)->get();
                        }else{
                            $products_option_2_items = ProductsOption2Items::where('products_item_pre_id',$products_transfer->products_item_id)
                            ->where('product_id',$products_item->product_id)->get();
                        }


                        $products = Products::where('id',$products_item->product_id)->first();
                        $qty = 0;
                        foreach($products_option_2_items as $item){

                            $products_option_1 = ProductsOption1::where('id',$item->option_1_id)->first();
                            $products_option_2 = ProductsOption2::where('id',$item->option_2_id)->first();

                            $stock_items = new StockItems();

                            if($products_transfer->is_preorder == 0){
                                $item_qty = $qty_new;
                                $item_qty_booking = $item->qty;
                            }else{
                                $stock_items_pre = StockItemsPre::select('qty_booking','id')->where('product_id',$products_item->product_id)
                                ->where('customer_id',$products_item->customer_id)
                                ->where('products_option_2_items_id',$item->id)
                                ->where('products_item_id',$products_transfer->products_item_id)
                                ->first();
                                $stock_items->stock_items_pre_id = $stock_items_pre->id;
                                $item_qty = $stock_items_pre->qty_booking;
                                $item_qty_booking = 0;
                            }

                            $stock_items->stock_id = $stock->id;
                            $stock_items->stock_lot_id = $stock_lot->id;
                            $stock_items->stock_shelt_id = $stock_shelf->id;
                            $stock_items->product_id = $products_item->product_id;
                            // $stock_items->store_id = $products_item->store_id; qty_booking
                            $stock_items->customer_id = $products_item->customer_id;

                            $stock_items->products_option_2_items_id = $item->id;
                            $stock_items->products_item_id = $products_transfer->products_item_id;
                            if($products_option_1->name_th!=''){
                                $stock_items->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
                            }else{
                                $stock_items->name = $products->name_th;
                            }
                            $stock_items->stock_floor_id = $stock_floor->id;
                            $stock_items->price = $item->price;
                            $stock_items->qty = $item_qty;
                            $stock_items->qty_booking = $item_qty_booking;
                            $stock_items->save();
                            $qty += $item_qty;

                            if($products_transfer->is_preorder == 1){
                                $stock_items_pre = StockItemsPre::select('qty_booking','id','stock_lot_id')->where('product_id',$products_item->product_id)
                                ->where('id',$stock_items->stock_items_pre_id)
                                ->where('customer_id',$products_item->customer_id)
                                ->where('products_option_2_items_id',$item->id)
                                ->where('products_item_id',$products_transfer->products_item_id)
                                ->first();

                                DB::table('customer_cart_product_cut_stock')->where('product_id',$products_item->product_id)
                                ->where('pre_order_status',1)
                                ->where('stock_lot_id',$stock_items_pre->stock_lot_id)
                                ->where('stock_item_id',$stock_items_pre->id)
                                ->where('pre_order_has_stock',0)
                                ->update([
                                    'stock_lot_id' =>  $stock_items->stock_lot_id,
                                    'stock_item_id' => $stock_items->id,
                                    'pre_order_has_stock' => 1,
                                ]);
                            }
                        }

                        if($products_transfer->is_preorder == 0){
                        $products->qty = $products->qty+$qty;
                        }
                        $products->approve_status = 1;
                        $products->save();

                        if($products_transfer->is_preorder == 0){
                        $stock_lot->qty = $qty;
                        $stock_lot->qty_booking = $qty;
                        }else{
                        $stock_lot->qty = $qty;
                        $stock_lot->qty_booking = 0;
                        }
                        $stock_lot->save();

                        $products_item->approve_status = 1;
                        $products_item->transfer_status = 3;
                        $products_item->save();

                        if($r->type == 'confirm_all'){
                            $products_transfer->qty = $products_transfer->qty;
                            $products_transfer->shipping_name = $products_transfer->shipping_name;
                        }else{
                            $products_transfer->qty = $r->qty;
                            $products_transfer->shipping_name = $r->shipping_name;
                        }

                        $products_transfer->shipping_remark = $r->shipping_remark;
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
        if($r->shipping_date == ''){
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date','<=',date('Y-m-d'))
            ->where('picking_status',0)->orderBy('shipping_date','asc')->get();
        }else{
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date',$r->shipping_date)
            ->where('picking_status',0)->orderBy('shipping_date','asc')->get();
        }

        $cart_success = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->orderBy('shipping_date','asc')->orderBy('id','asc')->get();
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
        if($r->shipping_date == ''){
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date','<=',date('Y-m-d'))
            ->where('picking_status',1)->where('scan_status',0)->orderBy('shipping_date','asc')->get();
        }else{
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date',$r->shipping_date)
            ->where('picking_status',1)->where('scan_status',0)->orderBy('shipping_date','asc')->get();
        }

        $cart_success = CustomerCart::where('status',2)->where('shipping_date','<=',date('Y-m-d'))->where('picking_status',1)->where('scan_status',1)->orderBy('shipping_date','asc')->orderBy('id','asc')->get();
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
        if($r->shipping_date == ''){
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date','<=',date('Y-m-d'))
            ->where('picking_status',1)->where('scan_status',1)->where('transfer_status',0)->orderBy('shipping_date','asc')->get();
        }else{
            $cart = CustomerCart::where('status',2)
            ->where('shipping_date',$r->shipping_date)
            ->where('picking_status',1)->where('scan_status',1)->where('transfer_status',0)->orderBy('shipping_date','asc')->get();
        }

        $status = [1,2];
        $cart_success = CustomerCart::where('status',2)
        // ->where('shipping_date','<=',date('Y-m-d'))
        ->where('picking_status',1)->where('scan_status',1)->whereIn('transfer_status',$status)->orderBy('shipping_date','desc')->get();
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
        // barcode transfer_status
        $cart = CustomerCart::where('customer_cart.id',$r->cart_id)->first();
        if($cart->pay_other_cart_id!=null){
            $cart_others = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
            ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
            ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
            ->where('customer_cart.id',$cart->pay_other_cart_id)->get();
        }else{
            $cart_others = [];
        }

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
            'products_option_2_items.name_th as items_name',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('products_option_2_items','products_option_2_items.id','customer_cart_product.products_option_2_items_id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)->get();

            $arr_lot = [];
            $arr_barcode = [];
            foreach($products as $index => $pro){
                $product_qty+=$pro->qty;

                // ดึงตำแหน่งสินค้า
                $customer_cart_product_cut_stock = CustomerCartProductCutStock::
                select('customer_cart_product_cut_stock.*','stock_lot.lot_number','dataset_shelf.name as shelf_name','products_option_2_items.barcode','stock_floor.floor','stock_items.name as stock_item_name')
                ->join('stock_items','stock_items.id','customer_cart_product_cut_stock.stock_item_id')
                ->join('stock_floor','stock_floor.id','stock_items.stock_floor_id')
                ->join('stock_shelf','stock_shelf.id','stock_items.stock_shelt_id')
                ->join('dataset_shelf','dataset_shelf.id','stock_shelf.shelf_id')
                ->join('stock_lot','stock_lot.id','stock_shelf.stock_lot_id')
                ->join('products_option_2_items','products_option_2_items.id','stock_items.products_option_2_items_id')
                ->where('customer_cart_product_cut_stock.customer_cart_product_id',$pro->id)
                ->get();

                foreach($customer_cart_product_cut_stock as $key => $c){
                    $arr_lot[$index][$key] = $c->lot_number.' > '.$c->shelf_name.' > '.$c->floor.' > '.$c->stock_item_name.' (Barcode:'.$c->barcode.')';
                }
            }

            $customer_address = Customer_address::
            select('customer_address.*','district_makesend.name as districts_name','amphures.name_th as amphures_name','province_makesend.name as provinces_name')
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

            $claim_status_success = 0;
            if($cart->claim_status==1){
                $claim = DB::table('customer_cart_claim')->select('status')->where('customer_cart_id',$cart->id)->first();
                if($claim->status!=0){
                    $claim_status_success = 1;
                }
            }

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
                    'cart_others' => $cart_others,
                    'claim_status_success' => $claim_status_success,
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

    public function api_get_cart_detail_store(Request $r)
    {
        // barcode transfer_status
        $store = Store::where('customer_id',$r->user_id)->first();

        $cart = CustomerCart::where('customer_cart.id',$r->cart_id)->first();
        if($cart->pay_other_cart_id!=null){
            $cart_others = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
            ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
            ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
            ->where('customer_cart.id',$cart->pay_other_cart_id)->get();
        }else{
            $cart_others = [];
        }

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
            'products_option_2_items.name_th as items_name',
            'customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('products_option_2_items','products_option_2_items.id','customer_cart_product.products_option_2_items_id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)
            ->where('customer_cart_product.store_id',$store->id)
            ->get();

            $arr_lot = [];
            $arr_barcode = [];
            $total_price_products = 0;
            foreach($products as $index => $pro){

                $total_price_products += $pro->total_price;

                $product_qty+=$pro->qty;

                // ดึงตำแหน่งสินค้า
                $customer_cart_product_cut_stock = CustomerCartProductCutStock::
                select('customer_cart_product_cut_stock.*','stock_lot.lot_number','dataset_shelf.name as shelf_name','products_option_2_items.barcode','stock_floor.floor','stock_items.name as stock_item_name')
                ->join('stock_items','stock_items.id','customer_cart_product_cut_stock.stock_item_id')
                ->join('stock_floor','stock_floor.id','stock_items.stock_floor_id')
                ->join('stock_shelf','stock_shelf.id','stock_items.stock_shelt_id')
                ->join('dataset_shelf','dataset_shelf.id','stock_shelf.shelf_id')
                ->join('stock_lot','stock_lot.id','stock_shelf.stock_lot_id')
                ->join('products_option_2_items','products_option_2_items.id','stock_items.products_option_2_items_id')
                ->where('customer_cart_product_cut_stock.customer_cart_product_id',$pro->id)
                ->get();

                foreach($customer_cart_product_cut_stock as $key => $c){
                    $arr_lot[$index][$key] = $c->lot_number.' > '.$c->shelf_name.' > '.$c->floor.' > '.$c->stock_item_name.' (Barcode:'.$c->barcode.')';
                }
            }

            $customer_address = Customer_address::
            select('customer_address.*','district_makesend.name as districts_name','amphures.name_th as amphures_name','province_makesend.name as provinces_name')
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

            $customer_cart_claim = CustomerCartClaim::where('customer_cart_id',$cart->id)->get();
            $customer = DB::table('customer')->where('id',$cart->customer_id)->first();

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
                    'cart_others' => $cart_others,
                    'total_price_products' => $total_price_products,
                    'customer_cart_claim' => $customer_cart_claim,
                    'customer' => $customer,
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

        $customer_cart_address = CustomerCartAddress::
        select('customer_cart_address.*','district_makesend.name as districts_name','amphures.name_th as amphures_name','province_makesend.name as provinces_name')
        ->join('districts','districts.id','customer_cart_address.district_id')
        ->join('amphures','amphures.id','customer_cart_address.amphures_id')
        ->join('provinces','provinces.id','customer_cart_address.province_id')
        ->where('customer_cart_address.customer_cart_id',$cart->id)
        ->first();


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
            $arr_barcode = [];
            foreach($products as $index => $pro){
                $product_qty+=$pro->qty;

                // ดึงตำแหน่งสินค้า
                $customer_cart_product_cut_stock = CustomerCartProductCutStock::
                select('customer_cart_product_cut_stock.*','stock_lot.lot_number','products_option_2_items.barcode','dataset_shelf.name as shelf_name','stock_floor.floor','stock_items.name as stock_item_name')
                ->join('stock_items','stock_items.id','customer_cart_product_cut_stock.stock_item_id')
                ->join('stock_floor','stock_floor.id','stock_items.stock_floor_id')
                ->join('stock_shelf','stock_shelf.id','stock_items.stock_shelt_id')
                ->join('dataset_shelf','dataset_shelf.id','stock_shelf.shelf_id')
                ->join('stock_lot','stock_lot.id','stock_shelf.stock_lot_id')
                ->where('customer_cart_product_cut_stock.customer_cart_product_id',$pro->id)
                ->join('products_option_2_items','products_option_2_items.id','stock_items.products_option_2_items_id')
                ->get();

                foreach($customer_cart_product_cut_stock as $key => $c){
                    $arr_lot[$index][$key] = $c->lot_number.' > '.$c->shelf_name.' > '.$c->floor.' > '.$c->stock_item_name.' (Barcode:'.$c->barcode.')';
                }
            }

            $customer_address = Customer_address::
            select('customer_address.*','district_makesend.name as districts_name','amphures.name_th as amphures_name','province_makesend.name as provinces_name')
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
                    'customer_cart_address'=>$customer_cart_address,
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
                // $product = Products::select('barcode','id')->where('barcode',$r->barcode)->first();
                if($r->barcode!='140'){
                    $product = DB::table('products_option_2_items')->select('product_id')->where('barcode',$r->barcode)->first();
                    if($product){
                        $product_cart = CustomerCartProduct::where('customer_cart_id',$r->id)->where('product_id',$product->product_id)->first();
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

                }else{
                    $product = CustomerCartProduct::where('customer_cart_id',$r->id)->get();
                    foreach($product as $p){
                        $product_cart = CustomerCartProduct::where('id',$p->id)->first();
                        $product_cart->scan_qty = $product_cart->pick_qty;
                        $product_cart->save();
                    }
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
                    $tracking_no1->tracking_no = 'BM'.$cart->customer_id.$cart->id.date('YmdHis');
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

                // if($r->tracking_no1 != ''){
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
                // }

                // if($r->tracking_no2 != ''){
                    $tracking_no2 = CustomerCartTracking::where('customer_cart_id',$cart->id)->where('no',2)->first();
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
                // }

                // if($r->tracking_no3 != ''){
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
                // }

                // if($r->tracking_no4 != ''){
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
                    $tracking_no4->save();
                // }

                // if($r->tracking_no5 != ''){
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
                    $tracking_no5->save();
                // }

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

    public function api_cart_receive(Request $r){
        DB::beginTransaction();
        try
        {
                $cart = CustomerCart::where('id',$r->id)->where('transfer_status','!=',2)->first();
                if($cart){
                    if($cart->picking_status == 1 && $cart->scan_status == 1 && $cart->transfer_status == 1){
                        $cart->transfer_status = 2;
                        $cart->received_date = date('Y-m-d H:i:s');
                    }
                    $cart->save();
                    $store_arr = [];
                    $cus_products = CustomerCartProduct::select('total_price','store_id')->where('customer_cart_id',$cart->id)->get();
                    foreach($cus_products as $cp){
                        // $p = Products::select('store_id')->where('id',$cp->product_id)->first();
                        // if($p){
                        //     $store = Store::where('id',$p->store_id)->first();
                        //     $store->credit = $store->credit + $cp->total_price;
                        //     $store->save();
                        // }
                        if(isset($store_arr[$cp->store_id])){
                            $store_arr[$cp->store_id] = $store_arr[$cp->store_id]+$cp->total_price;
                        }else{
                            $store_arr[$cp->store_id] = $cp->total_price;
                        }
                    }

                    $bringme_percent_gp = DB::table('bringme_percent_gp')->where('status',1)->first();
                    foreach($store_arr as $key => $price){
                        $income = $price*(100-$bringme_percent_gp->percent)/100;
                        // $store = Store::select('credit')->where('id',$key)->first();
                        // $store->credit = $store->credit + $income;
                        // $store->save();
                        $finance_movement = new FinanceMovement();
                        $finance_movement->store_id = $key;
                        $finance_movement->ref_type = 1;
                        $finance_movement->ref_id = $cart->id;
                        $finance_movement->transfer_status = 1;
                        $finance_movement->name = 'ออเดอร์ '.$cart->order_number;
                        $finance_movement->price = $income;
                        $finance_movement->status = 0;
                        $finance_movement->gp_percent = $bringme_percent_gp->percent;
                        $finance_movement->price_full = $price;
                        $finance_movement->save();
                    }


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

    public function api_get_order_point_list_store(Request $r)
    {
        $cart = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as delivery_type_name')
        ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
        ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
        ->where('customer_cart.id',$r->cart_id)->first();

        $store = Store::select('id')->where('customer_id',$r->user_id)->first();

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
            ->where('customer_cart_product.store_id',$store->id)
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
            ->where('customer_cart_product.store_id',$store->id)
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
                    // $CustomerCartProduct = CustomerCartProduct::where('customer_cart_id',$r->customer_cart_id)->first();
                    $cus_product_id_arr = explode(',',$r->cus_product_id_arr);
                    $cus_product_qty_claim_arr = explode(',',$r->cus_product_qty_claim_arr);
                    foreach($cus_product_id_arr as $index => $arr){
                        if($arr!=''){

                            $CustomerCartProduct = CustomerCartProduct::where('customer_cart_id',$r->customer_cart_id)->where('id',$arr)->first();
                            $CustomerCartProduct->claim_status = 1;
                            $CustomerCartProduct->qty_claim = $cus_product_qty_claim_arr[$index];
                            $CustomerCartProduct->save();

                            $product = Products::where('id',$CustomerCartProduct->product_id)->first();

                            $cart_claim = new CustomerCartClaim();
                            $cart_claim->customer_cart_id = $r->customer_cart_id;
                            $cart_claim->customer_id = $CustomerCart->customer_id;
                            $cart_claim->customer_cart_product_id = $arr;
                            $cart_claim->store_id = $product->store_id;
                            $cart_claim->problem_id = $r->problem_id;

                            if($r->problem_id == 1){
                                $cart_claim->problem = 'สินค้ามีปัญหาระหว่างการจัดส่ง';
                            }
                            if($r->problem_id == 2){
                                $cart_claim->problem = 'ตรวจสอบสินค้าแล้วพบว่าเกินกำหนดเวลา ตามฉลากวันหมดอายุ';
                            }

                            if($r->problem_id == 3){
                                $cart_claim->problem = 'ปัญหาอื่นๆ';
                                $cart_claim->other_problem = $r->other_problem;
                            }

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

                        }
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

    public function api_get_shipping_price(Request $r){

        $shipping_type_price_arr = [];
        $shipping_type_price = DB::table('shipping_type_price')
        // ->select('shipping_price')
        // ->where('shipping_type_id',1)
        ->where('min_price','<=',$r->product_total_price)
        ->where('max_price','>=',$r->product_total_price)
        ->orderBy('max_price','asc')
        ->get();

        $shipping_type_id_get = 0;
        $province_data = '';

        $provinces = DB::table('provinces')->where('id',$r->provinces_id)->first();
        if($provinces){
            $province_data = 'id : '.$provinces->id.' name : '.$provinces->name_th.' shipping_type_id : '.$provinces->shipping_type_id;
            if($provinces->shipping_type_id != null || $provinces->shipping_type_id != ''){
                $shipping_type_id_get = $provinces->shipping_type_id;
            }else{
                $shipping_type_id_get = 7;
            }
        }

        foreach( $shipping_type_price as $p){
            $shipping_type_price_arr[$p->shipping_type_id] = $p->shipping_price;
        }

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'shipping_type_price_arr' => $shipping_type_price_arr,
                    'shipping_type_id_get' => $shipping_type_id_get,
                    'province_data'=>$province_data,
                ],
            ]);
    }

     public function api_store_update(Request $r){
         DB::beginTransaction();
            try
                {
                    $customer = Customer::where('id',$r->user_id)->first();
                    if($customer){
                        $store = Store::where('customer_id',$r->user_id)->first();
                        $store->products_new_show = $r->products_new_show;
                        $store->products_good_show = $r->products_good_show;
                        $store->products_recom_show = $r->products_recom_show;
                        $store->save();

                        if($r->banner!=''){
                            Storage::disk('public')->delete('customer/'.$store->customer_id.'/' . $store->banner);
                            $image_64 = $r->banner;
                            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                             // find substring fro replace here eg: data:image/png;base64,
                            $image = str_replace($replace, '', $image_64);
                            $image = str_replace(' ', '+', $image);
                            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                            Storage::disk('public')->put('customer/'.$store->customer_id.'/' . $imageName, base64_decode($image));
                            $store->banner_path = 'customer/'.$store->customer_id.'/';
                            $store->banner = $imageName;
                            $store->save();
                            // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                        }

                        if($r->logo!=''){
                            Storage::disk('public')->delete('customer/'.$store->customer_id.'/' . $store->logo);
                            $image_64 = $r->logo;
                            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                             // find substring fro replace here eg: data:image/png;base64,
                            $image = str_replace($replace, '', $image_64);
                            $image = str_replace(' ', '+', $image);
                            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                            Storage::disk('public')->put('customer/'.$store->customer_id.'/' . $imageName, base64_decode($image));
                            $store->logo_path = 'customer/'.$store->customer_id.'/';
                            $store->logo = $imageName;
                            $store->save();
                            // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                        }

                    }else{
                        return response()->json([
                            'message' => 'ไม่พบข้อมูล',
                            'status' => 0,
                            'data' => '',
                        ]);
                    }


                    DB::commit();
                    return response()->json([
                        'message' => 'บันทึกสำเร็จ',
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

        public function api_store_following_update(Request $r){

            DB::beginTransaction();
            try
                {
                    $store = Store::where('id',$r->store_id)->first();
                    if($store){
                        $follow = DB::table('store_following')
                        ->where('customer_id',$r->customer_id)
                        ->where('store_id',$r->store_id)
                        ->first();
                        if($follow){
                            if($follow->status == 1){
                                DB::table('store_following')
                                ->where('customer_id',$r->customer_id)
                                ->where('store_id',$r->store_id)
                                ->update([
                                    'status' => 0,
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]);
                                $store->following = $store->following-1;
                                $store->save();
                                $message = 'ยกเลิกติดตามร้านค้าแล้ว';
                            }else{
                                DB::table('store_following')
                                ->where('customer_id',$r->customer_id)
                                ->where('store_id',$r->store_id)
                                ->update([
                                    'status' => 1,
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]);
                                $store->following = $store->following+1;
                                $store->save();
                                $message = 'ติดตามร้านค้าสำเร็จ';
                            }
                        }else{
                            DB::table('store_following')->insert(
                                [
                                    'customer_id' => $r->customer_id,
                                    'store_id' => $r->store_id,
                                    'status' => 1,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ]
                            );
                            $store->following = $store->following+1;
                            $store->save();
                            $message = 'ติดตามร้านค้าสำเร็จ';
                        }
                    }

                    $follow = DB::table('store_following')
                    ->where('customer_id',$r->customer_id)
                    ->where('store_id',$r->store_id)
                    ->first();

                    DB::commit();
                    return response()->json([
                        'message' => $message,
                        'status' => 1,
                        'data' => [
                            'following' => $follow->status,
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

    public function api_get_product_list_category(Request $r)
    {
        if(!isset($r->brand_id)){
            $products = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'store.logo_path','store.logo',
            )
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->where('products.category_id',$r->category_id)
            ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();
        }else{
            if($r->brand_id!=0){
                $products = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                'store.logo_path','store.logo',
                )
                ->join('products_item','products_item.product_id','products.id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->join('store','store.id','products.store_id')
                ->where('products_gallery.use_profile',1)
                ->where('products_item.transfer_status',3)
                ->where('products.display_status',1)
                ->where('products.category_id',$r->category_id)
                ->where('products.brands_id',$r->brand_id)
                ->orderBy('products.sale_number','desc')
                ->inRandomOrder()->get();
            }else{
                $products = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                'store.logo_path','store.logo',
                )
                ->join('products_item','products_item.product_id','products.id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->join('store','store.id','products.store_id')
                ->where('products_gallery.use_profile',1)
                ->where('products_item.transfer_status',3)
                ->where('products.display_status',1)
                ->where('products.category_id',$r->category_id)
                ->orderBy('products.sale_number','desc')
                ->inRandomOrder()->get();
            }
        }

        $url_img = Storage::disk('public')->url('');

        $category = Category::where('status',1)->where('id',$r->category_id)->get();
        $categorys = Category::where('status',1)->where('id','!=',$r->category_id)->get();
        $brands = Brands::where('status',1)->orderBy('name_th','asc')->get();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'category' => $category,
                    'categorys' => $categorys,
                    'url_img' => $url_img,
                    'brands' => $brands,
                ],
            ]);

    }

    public function api_get_question_ans(Request $r)
    {
        $question_ans = DB::table('question_ans')->orderBy('id','desc')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'question_ans' => $question_ans,
                ],
            ]);
    }

    public function api_get_web_data(Request $r)
    {
        $policy = DB::table('policy')->orderBy('id','desc')->first();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'policy' => $policy,
                ],
            ]);
    }

    public function api_favorite_update(Request $r){

        DB::beginTransaction();
        try
            {
                if($r->favorite){

                }
                $favorite_customer = DB::table('favorite_customer')->select('status')->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();
                if($favorite_customer){
                    if($favorite_customer->status==1){
                        DB::table('favorite_customer')->select('status')->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->update([
                            'status' => 0,
                        ]);
                    }else{
                        DB::table('favorite_customer')->select('status')->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->update([
                            'status' => 1,
                        ]);
                    }
                }else{
                    DB::table('favorite_customer')->insert([
                        'customer_id' => $r->user_id,
                        'product_id' => $r->product_id,
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }

                // $favorite_customer = DB::table('favorite_customer')->select('status')->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();

                DB::commit();
                return response()->json([
                    'message' => 'success',
                    'status' => 1,
                    'data' => [
                        // 'favorite_customer' => $favorite_customer,
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

    public function api_reset_password(Request $r)
    {

        $customer = DB::table('customer')->where('email',$r->email)->first();
        if(!$customer){
            return response()->json([
                'message' =>  'ไม่พบผู้ใช้ในระบบ',
                'status' => 0,
                'data' => '',
            ]);
        }

        DB::beginTransaction();
        try
            {

        DB::table('reset_password')->where('customer_id',$customer->id)->update([
            'customer_id' => $customer->id,
            'date_end' => Carbon::parse(date('Y-m-d H:i:s'))->addDays(1),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 0,
        ]);

        // $reset_password = new ResetPassword();
        // $reset_password->customer_id = $customer->id;
        // $reset_password->date_end = Carbon::parse(date('Y-m-d H:i:s'))->addDays(1);
        // $reset_password->save();
        // $receiver = $r->email;
        // $subject = 'App Befriends แจ้งลืมรหัสผ่าน';
        // $name = 'applicationbefriends';
        // $sender = 'applicationbefriends@gmail.com';
        // $message = 'ท่านสามารถรีเซ็ตรหัสผ่านใหม่ได้โดยคลิกที่ <a href="https://appbefriends.com/reset_password/'.$reset_password->id.'" target="_blank">เปลี่ยนรหัสผ่าน</a>';

        // try {

        // $url = 'http://wut.orangeworkshop.info/ansportagency/api/api_sendmail_befriend_app';

        // $curl = curl_init();

        // $fields = array(
        //     'receiver' => $receiver,
        //     'subject' => $subject,
        //     'name' => $name,
        //     'email' => $sender,
        //     'message' => $message
        // );

        // $fields_string = http_build_query($fields);

        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_POST, TRUE);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);

        // $data_r = curl_exec($curl);

        // curl_close($curl);

        // // $response =  json_decode($response);  //แปลง string ที่ได้เป็น object
        // // var_dump($response);
        // // echo "<script> location.href='contact.php'; </script>";
        // } catch (Exception $e) {
        //     // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //     return response()->json([
        //         'message' =>  $mail->ErrorInfo,
        //         'status' => 0,
        //         'data' => '',
        //     ]);

        // }


        DB::commit();
        return response()->json([
            'message' => 'สำเร็จ กรุณาตรวจสอบที่ email ของท่าน',
            'status' => 1,
            'data' =>'',
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

    public function api_get_product_favorite(Request $r)
    {
        $favorite = DB::table('favorite_customer')->select('product_id')->where('customer_id',$r->user_id)->where('status',1)->pluck('product_id')->toArray();
        $products = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
        'products_gallery.path as gal_path',
        'products_gallery.name as gal_name',
        'store.logo_path','store.logo',
        )
        ->join('products_item','products_item.product_id','products.id')
        ->join('products_gallery','products_gallery.product_id','products.id')
        ->join('store','store.id','products.store_id')
        ->where('products_gallery.use_profile',1)
        ->where('products_item.transfer_status',3)
        ->where('products.display_status',1)
        ->whereIn('products.id',$favorite)
        ->orderBy('products.sale_number','desc')
        ->inRandomOrder()->get();

        $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'url_img' => $url_img,
                ],
            ]);

    }

    public function api_get_report_store(Request $r)
    {
        $store = Store::where('customer_id',$r->user_id)->first();
        if($store){
            $store_success = DB::table('customer_cart_store')->select('customer_cart_id')->where('store_id',$store->id)->pluck('customer_cart_id')->toArray();
            $carts_success = CustomerCart::select('id')->whereIn('id',$store_success)->where('status',2)->where('transfer_status',2)->orderBy('id','desc')->get();
            $order_number = count($carts_success);

            $sale_number = 0;
            $cart_arr = [];
            foreach($carts_success as $c){
                array_push($cart_arr,$c->id);
                $products = CustomerCartProduct::select('total_price')->where('customer_cart_id',$c->id)->where('store_id',$store->id)->get();
                foreach($products as $p){
                    $sale_number+= $p->total_price;
                }
            }

            $visitor_number = $store->visitor_number;

            // $product_list = Products::where('store_id',$store->id)->where('approve_status',1)->get();
            $product_list = Products::select('products.id'
            // ,'products_item.transfer_status',
            // 'products_item.id as products_item_id',
            // 'products_gallery.path as gal_path',
            // 'products_gallery.name as gal_name',
            )
            // ->join('products_item','products_item.product_id','products.id')
            // ->join('products_gallery','products_gallery.product_id','products.id')
            // ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            // ->where('products_item.transfer_status',3)
            // ->orderBy('products.updated_at','desc')
            ->where('products.approve_status',1)
            ->get();

            $products_total_price_arr = [];
            $products_total_qty_arr = [];
            $arr_products = [];
            foreach($product_list as $p){
                $total_price = CustomerCartProduct::select('total_price')->whereIn('customer_cart_id',$cart_arr)->where('store_id',$store->id)->where('product_id',$p->id)->sum('total_price');
                $products_total_price_arr[$p->id] = $total_price;

                if($total_price>0){
                    array_push($arr_products,$p->id);
                }

                $qty = CustomerCartProduct::select('qty')->whereIn('customer_cart_id',$cart_arr)->where('store_id',$store->id)->where('product_id',$p->id)->sum('qty');
                $products_total_qty_arr[$p->id] = $qty;
            }

            if(count($arr_products)>0){
                $product_list = Products::select('products.*','products_item.transfer_status',
                'products_item.id as products_item_id',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                )
                ->join('products_item','products_item.product_id','products.id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->where('products_gallery.use_profile',1)
                ->where('products.store_id',$store->id)
                // ->whereIn('products.id',$arr_products)
                // ->where('products_item.transfer_status',3)
                // ->orderBy('products.updated_at','desc')
                ->where('products.approve_status',1)
                ->where('products.display_status',1)
                ->get();
            }else{
                $product_list = Products::select('products.*','products_item.transfer_status',
                'products_item.id as products_item_id',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                )
                ->join('products_item','products_item.product_id','products.id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->where('products_gallery.use_profile',1)
                ->where('products.store_id',$store->id)
                // ->where('products.id',0)
                // ->where('products_item.transfer_status',3)
                // ->orderBy('products.updated_at','desc')
                ->where('products.approve_status',1)
                ->where('products.display_status',1)
                ->get();
            }


        $url_img = Storage::disk('public')->url('');
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                'order_number' => $order_number,
                'sale_number' => $sale_number,
                'visitor_number' => $visitor_number,
                'url_img' => $url_img,
                'store' => $store,
                'products_total_price_arr' => $products_total_price_arr,
                'products_total_qty_arr' => $products_total_qty_arr,
                'product_list' => $product_list,

                ],
            ]);
        }else{
            return response()->json([
                'message' =>  'ไม่พบข้อมูล',
                'status' => 0,
                'data' => '',
            ]);
        }

    }

    //App\Http\Controllers\API2Controller::pdf_barcode($product_id,$item_id,$count); //count = จำนวนที่ต้องการปริ้น
    public function pdf_barcode($product_id,$item_id,$count)
    {
        $file = new Filesystem;
        $file->cleanDirectory(public_path('pdf/'));


        $product = DB::table('products')
            ->where('id', $product_id)
            ->first();

        $barcode = DB::table('products_option_2_items')
            ->where('product_id', $item_id)
            ->first();

        $data = ['product' => $product, 'barcode' => $barcode];

        // Create a PDF instance using the PDF facade
        $pdf = PDF::loadView('backend.PDF.barcode', compact('data'));


        for ($i = 0; $i < $count; $i++) {
            $pathfile = public_path('pdf/'.$item_id.'_'.$i.'.pdf');
            $pdf->save($pathfile);

        }

        $this->merger_pdf();
        $url =  asset('local/public/pdf/result.pdf');

         return $url;
    }

}

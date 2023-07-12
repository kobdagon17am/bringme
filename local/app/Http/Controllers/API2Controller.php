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

class API2Controller extends Controller
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
                    // $stock_shelf->store_id = $products_item->store_id;
                    $stock_shelf->customer_id = $products_item->customer_id;
                    $stock_shelf->name = 'Shelf 1';
                    $stock_shelf->save();

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

                        $stock_items->name = $products->name_th.' : '.$products_option_1.' '.$products_option_2;
                        $stock_items->qty = $item->qty;
                        $stock_items->price = $item->price;
                        $stock_items->save();
                        $qty += $item->qty;
                    }
                    $products->qty = $products->qty+$qty;
                    $products->approve_status = 1;
                    $products->save();

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


}

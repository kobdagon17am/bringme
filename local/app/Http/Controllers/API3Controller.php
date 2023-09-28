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
Use App\Models\ProductsGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
Use App\Models\CustomerCartProductCutStock;
Use App\Models\ProductsComment;
use App\Models\CustomerCartAddress;

class API3Controller extends Controller
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

     public function api_get_finance(Request $r)
     {
        $store = Store::where('customer_id',$r->user_id)->first();
         if($store){
             return response()->json([
                 'message' => 'ทำรายการสำเร็จ',
                 'status' => 1,
                 'data' => [
                     'store' => $store,
                 ],
             ]);
         }else{
             return response()->json([
                 'message' =>  'ไม่พบข้อมูลสินค้า',
                 'status' => 0,
                 'data' => '',
             ]);
         }
     }

     public function api_update_finance()
     {
        echo "Date Diff = ".$this->DateDiff("2023-09-28 13:32:20","2023-09-28 13:32:20")."<br>";
        echo "Time Diff = ".$this->TimeDiff("00:00","19:00")."<br>";
        echo "Date Time Diff = ".$this->DateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
        // $setting_period_finance = DB::table('setting_period_finance')->where('status',1)->first();
        // if($setting_period_finance){
        //     $customer_cart = CustomerCart::select('id','received_date')->where('transfer_status',2)->where('on_withdraw',0)->orderBy('received_date','asc')->get();
        //     foreach($customer_cart as $c){



        //         echo "Date Diff = ".DateDiff("2008-08-01","2008-08-31")."<br>";
        //         echo "Time Diff = ".TimeDiff("00:00","19:00")."<br>";
        //         echo "Date Time Diff = ".DateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";

        //     }

        //     return response()->json([
        //         'message' => 'ทำรายการสำเร็จ',
        //         'status' => 1,
        //         'data' => [
        //             'store' => $store,
        //         ],
        //     ]);
        // }else{
        //     return response()->json([
        //         'message' =>  'ไม่พบข้อมูลสินค้า',
        //         'status' => 0,
        //         'data' => '',
        //     ]);
        // }
     }
}

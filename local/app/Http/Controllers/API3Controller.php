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
Use App\Models\FinanceMovement;
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
            $finance_movement = FinanceMovement::where('store_id',$store->id)->orderBy('created_at','desc')->get();
            $finance_movement_hold_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',1)->where('status',0)->where('ref_type',1)->sum('price');
            $finance_movement_income_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',1)->sum('price');
            $finance_movement_withdraw_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',2)->sum('price');
            $url_img = Storage::disk('public')->url('');

             return response()->json([
                 'message' => 'ทำรายการสำเร็จ',
                 'status' => 1,
                 'data' => [
                     'store' => $store,
                     'finance_movement' => $finance_movement,
                     'finance_movement_hold_price' => $finance_movement_hold_price,
                     'finance_movement_income_price' => $finance_movement_income_price,
                     'finance_movement_withdraw_price' => $finance_movement_withdraw_price,
                     'url_img' => $url_img,
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
        DB::beginTransaction();
        try
        {

        $setting_period_finance = DB::table('setting_period_finance')->where('status',1)->first();
        $bringme_percent_gp = DB::table('bringme_percent_gp')->where('status',1)->first();

            // $customer_cart = CustomerCart::select('id','received_date')->where('transfer_status',2)->where('on_withdraw',0)->orderBy('received_date','asc')->get();
            // foreach($customer_cart as $c){

                $finance_movement = FinanceMovement::select('id','created_at')->where('transfer_status',1)->where('status',0)->where('ref_type',1)->orderBy('created_at','asc')->get();

                foreach($finance_movement as $c){

                $diff_date = $this->DateDiff($c->created_at,date('Y-m-d H:i:s'));
                if($diff_date<1){
                    $diff_date = 0;
                }

                if($diff_date<=$setting_period_finance->after_day){

                    $data = FinanceMovement::where('id',$c->id)->first();
                    $data->status = 1;
                    $data->save();

                    $store = Store::where('id',$data->store_id)->first();
                    $store->credit = $store->credit + $data->price;
                    $store->save();
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'setting_period_finance' => $setting_period_finance,
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

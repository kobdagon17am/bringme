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
use App\Models\CustomerAcc;
use App\Models\Withdraw;

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

            $date_start = date('Y-m').'-01 00:00:01';
            $date_end = date('Y-m').'-31 23:59:59';

            if(isset($r->year)){
                if($r->year!=''){
                    $date_start = $r->year.'-'.$r->month.'-01 00:00:01';
                    $date_end = $r->year.'-'.$r->month.'-31 23:59:59';
                }
            }

            $finance_movement = FinanceMovement::where('store_id',$store->id)
            ->whereBetween('created_at', [$date_start,$date_end])
            ->orderBy('created_at','desc')->get();
            $finance_movement_hold_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',1)->where('status',0)->where('ref_type',1)->sum('price');
            $finance_movement_income_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',1)->sum('price');
            $finance_movement_withdraw_price = FinanceMovement::select('price')->where('store_id',$store->id)->where('transfer_status',2)->sum('price');
            $url_img = Storage::disk('public')->url('');

            $customer_acc = CustomerAcc::select('customer_acc.*','bank.txt_desc')->join('bank','bank.id','customer_acc.bank_id')->where('customer_acc.used',1)->where('customer_acc.store_id',$store->id)->first();
            $period_withdraw = DB::table('period_withdraw')->first();
            $withdraw_last = Withdraw::select('created_at')->where('store_id',$store->id)->where('status','!=',2)->orderBy('created_at','desc')->first();

            $date_check = date('Y-m'.'-'.str_pad($period_withdraw->day, 2, '0', STR_PAD_LEFT));

            if($withdraw_last){
                if(date_format($withdraw_last->created_at,'Y-m-d') < $date_check){

                    $period_withdraw_status = 1;
                }else{
                    $period_withdraw_status = 0;
                }
            }else{
                $period_withdraw_status = 1;
            }

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
                     'customer_acc' => $customer_acc,
                     'period_withdraw_status' => $period_withdraw_status,
                     'withdraw_last' => $withdraw_last,
                     'w_day' => $period_withdraw->day,
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

     public function api_customer_acc_add(Request $r)
     {
        DB::beginTransaction();
        try
        {
            $store = Store::where('customer_id',$r->user_id)->first();
            if($store){
                if($r->used == 1){
                    DB::table('customer_acc')->where('store_id',$store->id)->update([
                        'used' => 0,
                    ]);
                }

                $customer_acc = new CustomerAcc();
                $customer_acc->store_id = $store->id;
                $customer_acc->bank_id = $r->bank_id;
                $customer_acc->acc_name = $r->acc_name;
                $customer_acc->acc_number = $r->acc_number;
                $customer_acc->used = $r->used;
                $customer_acc->save();

                if($r->acc_img!=''){
                    // Storage::disk('public')->delete('customer/acc/'.$store->customer_id.'/' . $store->acc_img);
                    $image_64 = $r->acc_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                     // find substring fro replace here eg: data:image/png;base64,
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('customer/acc/'.$store->customer_id.'/' . $imageName, base64_decode($image));
                    $customer_acc->acc_path = 'customer/acc/'.$store->customer_id.'/';
                    $customer_acc->acc_img = $imageName;
                    $customer_acc->save();
                    // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'customer_acc' => $customer_acc,
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

     public function api_get_acc_list(Request $r)
     {
        $store = Store::where('customer_id',$r->user_id)->first();
        if($store){
            $customer_acc = CustomerAcc::select('customer_acc.*','bank.txt_desc')->join('bank','bank.id','customer_acc.bank_id')->where('customer_acc.store_id',$store->id)->orderBy('customer_acc.id','desc')->get();
        }else{
            return response()->json([
                'message' => 'ไม่พบช้อมูลผู้ใช้',
                'status' => 0,
                'data' => [
                ],
            ]);
        }
             return response()->json([
                 'message' => 'สำเร็จ',
                 'status' => 1,
                 'data' => [
                     'customer_acc' => $customer_acc,
                 ],
             ]);
     }

     public function api_select_customer_acc(Request $r)
     {
        $store = Store::where('customer_id',$r->user_id)->first();
        if($store){
            $customer_acc = DB::table('customer_acc')->where('store_id',$store->id)->update([
                'used' => '0'
            ]);
            $customer_acc = DB::table('customer_acc')->where('store_id',$store->id)->where('id',$r->acc_id)->update([
                'used' => '1'
            ]);
            $customer_acc = DB::table('customer_acc')->where('store_id',$store->id)->where('id',$r->acc_id)->first();
        }else{
            return response()->json([
                'message' => 'ไม่พบช้อมูลผู้ใช้',
                'status' => 0,
                'data' => [
                ],
            ]);
        }
             return response()->json([
                 'message' => 'สำเร็จ',
                 'status' => 1,
                 'data' => [
                     'customer_acc' => $customer_acc,
                 ],
             ]);
     }

     public function api_add_withdraw(Request $r)
     {
        DB::beginTransaction();
        try
        {
            $store = Store::where('customer_id',$r->user_id)->first();
            if($store){
                if($store->credit< $r->price){
                    return response()->json([
                        'message' =>  'จำนวนยอดที่ถอนได้ของท่านไม่เพียงพอ',
                        'status' => 0,
                        'data' => '',
                    ]);
                }else{
                    $customer_acc = CustomerAcc::where('id',$r->acc_id)->where('store_id',$store->id)->first();
                    if($customer_acc){
                        $withdraw = new Withdraw();
                        $withdraw->store_id = $store->id;
                        $withdraw->price = $r->price;
                        $withdraw->bank_id = $customer_acc->bank_id;
                        $withdraw->acc_name = $customer_acc->acc_name;
                        $withdraw->acc_number = $customer_acc->acc_number;
                        $withdraw->status = 0;
                        $withdraw->save();

                        $movement = new FinanceMovement();
                        $movement->store_id = $store->id;
                        $movement->ref_type = 2;
                        $movement->ref_id = $withdraw->id;

                        $movement->transfer_status = 2;
                        $movement->name = 'ถอนเงินไปที่บัญชี ('.$customer_acc->acc_number.')';
                        $movement->price = $r->price;
                        $movement->status = 0;
                        $movement->gp_percent = 0;
                        $movement->price_full = $r->price;
                        $movement->save();

                        // บันทึกยอดล่าสุด
                        $store->credit = $store->credit-$r->price;
                        $store->save();

                    }else{
                        return response()->json([
                            'message' =>  'ไม่พบข้อมูล2',
                            'status' => 0,
                            'data' => '',
                        ]);
                    }
                }


            }else{
                return response()->json([
                    'message' =>  'ไม่พบข้อมูล',
                    'status' => 0,
                    'data' => '',
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    // 'setting_period_finance' => $setting_period_finance,
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

     public function api_add_brands(Request $r)
     {
        DB::beginTransaction();
        try
        {
            $store = Store::where('customer_id',$r->user_id)->first();
            if($store){
                $brands_new = Brands::where('name_th',$r->brand_add)->where('status',1)->first();
                if($brands_new){
                    return response()->json([
                        'message' =>  'แบรนด์นี้มีในระบบแล้ว',
                        'status' => 0,
                        'data' => '',
                    ]);
                }else{
                    $brands_new = new Brands();
                    $brands_new->name_th = $r->brand_add;
                    $brands_new->name_en = $r->brand_add;
                    $brands_new->status = 1;
                    $brands_new->has_store = 0;
                    $brands_new->store_id = $store->id;
                    $brands_new->save();
                }

            }else{
                return response()->json([
                    'message' =>  'ไม่พบข้อมูลของคุณ',
                    'status' => 0,
                    'data' => '',
                ]);
            }

            $brands = DB::table('brands')->where('has_store',0)->orderBy('name_th','asc')->get();
            $brands_store = DB::table('brands')->where('id',$store->brands_id)->orderBy('name_th','asc')->get();

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'brands' => $brands,
                    'brands_store' => $brands_store,
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

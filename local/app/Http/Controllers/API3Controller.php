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
use App\Models\MessageList;

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
                    'brands_new' => $brands_new,
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

     public function api_re_db(Request $r)
     {
        // DB::table('customer')->truncate();
        // DB::table('customer_acc')->truncate();
        // DB::table('customer_address')->truncate();
        DB::table('customer_cart')->truncate();
        DB::table('customer_cart_address')->truncate();
        DB::table('customer_cart_claim')->truncate();
        DB::table('customer_cart_product')->truncate();
        DB::table('customer_cart_product_cut_stock')->truncate();
        DB::table('customer_cart_store')->truncate();
        DB::table('customer_cart_tracking')->truncate();
        DB::table('customer_cart_tracking_item')->truncate();
        DB::table('db_stock_movement')->truncate();
        // DB::table('favorite_customer')->truncate();
        DB::table('finance_movement')->truncate();
        // DB::table('noti_log')->truncate();
        DB::table('payment')->truncate();
        DB::table('products')->truncate();
        DB::table('products_comment')->truncate();
        DB::table('products_gallery')->truncate();
        DB::table('products_item')->truncate();
        DB::table('products_option_1')->truncate();
        DB::table('products_option_2')->truncate();
        DB::table('products_option_2_items')->truncate();
        DB::table('products_option_head')->truncate();
        DB::table('products_transfer')->truncate();
        DB::table('stock')->truncate();
        DB::table('stock_floor')->truncate();
        DB::table('stock_items')->truncate();
        DB::table('stock_items_pre')->truncate();
        DB::table('stock_lot')->truncate();
        DB::table('stock_lot_pre')->truncate();
        DB::table('stock_pre')->truncate();
        DB::table('stock_shelf')->truncate();
        // DB::table('store')->truncate();
        DB::table('store_following')->truncate();
        DB::table('withdraw')->truncate();
        return 'success';
     }

     public function api_send_message(Request $r)
     {
        DB::beginTransaction();
        try
        {
            $customer_1 = Customer::select('select_type','id','profile_img_path','profile_img','name')->where('id',$r->customer_id)->first();
            $customer_2 = Customer::select('select_type','id','profile_img_path','profile_img','name')->where('id',$r->customer_id_2)->first();
            $customer_2->select_type = $r->user2_type;
            $message_list = MessageList::where('customer_id',$r->customer_id)->where('customer_id_2',$r->customer_id_2)->first();
            if(!$message_list){
                $message_list =  new MessageList();
                $message_list->customer_id = $r->customer_id;
                $message_list->customer_id_2 = $r->customer_id_2;
                $message_list->save();
            }
            $message = $message_list->message;
            if($message!=''){
                $message =  json_decode($message);
            }

            $message[] = [
                'author' => 'user',
                'createdAt' => $r->createdAt,
                'id' => $r->id,
                'status' => 'unseen',
                'text' => $r->text,
                'type' => $r->type,
            ];

            $message =  json_encode($message);

            $message_list->message = $message;
            $message_list->last_message = $r->text;
            $message_list->send_type = 1;
            $message_list->message_type = 1;
            $message_list->read_status = 0;
            $message_list->save();

            if($message_list->customer_1_is == ''){
                $message_list->customer_1_is = $customer_1->select_type;
                $message_list->save();
            }
            if($message_list->customer_2_is == ''){
                $message_list->customer_2_is = $customer_2->select_type;
                $message_list->save();


            if($customer_2->select_type==1){
                $url_img = Storage::disk('public')->url('').$customer_2->profile_img_path.$customer_2->profile_img;
                $name = $customer_2->name;
                if($customer_2->profile_img==''){
                    $url_img = 'nopic';
                }
            }else{
                $store = Store::select('logo_path','logo','store_name')->where('customer_id',$customer_2->id)->first();
                $url_img = Storage::disk('public')->url('').$store->logo_path.$store->logo;
                $name = $store->store_name;
            }
            $message_list->url_img = $url_img;
            $message_list->name = $name;
            $message_list->save();
            }


            // ฝั่งผู้รับ
            $message_list2 = MessageList::where('customer_id',$r->customer_id_2)->where('customer_id_2',$r->customer_id)->first();
            if(!$message_list2){
                $message_list2 =  new MessageList();
                $message_list2->customer_id = $r->customer_id_2;
                $message_list2->customer_id_2 = $r->customer_id;
                $message_list2->save();
            }
            $message2 = $message_list2->message;
            if($message2!=''){
                $message2 =  json_decode($message2);
            }

            $message2[] = [
                'author' => 'user2',
                'createdAt' => $r->createdAt,
                'id' => $r->id,
                'status' => 'unseen',
                'text' => $r->text,
                'type' => $r->type,
            ];

            $message2 =  json_encode($message2);

            $message_list2->message = $message2;
            $message_list2->last_message = $r->text;
            $message_list2->send_type = 2;
            $message_list2->message_type = 1;
            $message_list2->read_status = 0;
            $message_list2->save();

            if($message_list2->customer_1_is == ''){
                $message_list2->customer_1_is = $customer_2->select_type;
                $message_list2->save();
            }
            if($message_list2->customer_2_is == ''){
                $message_list2->customer_2_is = $customer_1->select_type;
                $message_list2->save();

                if($customer_1->select_type==1){
                    $url_img = Storage::disk('public')->url('').$customer_1->profile_img_path.$customer_1->profile_img;
                    if($customer_1->profile_img==''){
                        $url_img = 'nopic';
                    }
                     $name = $customer_1->name;
                }else{
                    $store = Store::select('logo_path','logo','store_name')->where('customer_id',$customer_1->id)->first();
                    $url_img = Storage::disk('public')->url('').$store->logo_path.$store->logo;
                      $name = $store->store_name;
                }
                $message_list2->url_img = $url_img;
                $message_list2->name = $name;
                $message_list2->save();
            }



            // return response()->json([
            //     'message' =>  'ไม่พบข้อมูลของคุณ',
            //     'status' => 0,
            //     'data' => '',
            // ]);

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    // 'brands' => $brands,
                    // 'brands_store' => $brands_store,
                    // 'brands_new' => $brands_new,
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

     public function api_send_image(Request $r)
     {
        DB::beginTransaction();
        try
        {
            $customer_1 = Customer::select('select_type','id','profile_img_path','profile_img','name')->where('id',$r->customer_id)->first();
            $customer_2 = Customer::select('select_type','id','profile_img_path','profile_img','name')->where('id',$r->customer_id_2)->first();
            $customer_2->select_type = $r->user2_type;
            $message_list = MessageList::where('customer_id',$r->customer_id)->where('customer_id_2',$r->customer_id_2)->first();
            if(!$message_list){
                $message_list =  new MessageList();
                $message_list->customer_id = $r->customer_id;
                $message_list->customer_id_2 = $r->customer_id_2;
                $message_list->save();
            }
            $message = $message_list->message;
            if($message!=''){
                $message =  json_decode($message);
            }

            $message[] = [
                'author' => 'user',
                'name' => $r->name,
                'createdAt' => $r->createdAt,
                'id' => $r->id,
                'status' => 'unseen',
                'text' => '',
                'size' => $r->size,
                'height' => $r->height,
                'width' => $r->width,
                'uri' => $r->uri,
                'type' => $r->type,
            ];

            $message =  json_encode($message);

            $message_list->message = $message;
            $message_list->last_message = 'Image file';
            $message_list->send_type = 1;
            $message_list->message_type = 1;
            $message_list->read_status = 0;
            $message_list->save();

            if($message_list->customer_1_is == ''){
                $message_list->customer_1_is = $customer_1->select_type;
                $message_list->save();
            }
            if($message_list->customer_2_is == ''){
                $message_list->customer_2_is = $customer_2->select_type;
                $message_list->save();

                if($customer_2->select_type==1){
                    $url_img = Storage::disk('public')->url('').$customer_2->profile_img_path.$customer_2->profile_img;
                    if($customer_2->profile_img==''){
                        $url_img = 'nopic';
                    }
                    $name = $customer_2->name;
                }else{
                    $store = Store::select('logo_path','logo','store_name')->where('customer_id',$customer_2->id)->first();
                    $url_img = Storage::disk('public')->url('').$store->logo_path.$store->logo;
                    $name = $store->store_name;
                }
                $message_list->url_img = $url_img;
                $message_list->name = $name;
                $message_list->save();
            }



            // ฝั่งผู้รับ
            $message_list2 = MessageList::where('customer_id',$r->customer_id_2)->where('customer_id_2',$r->customer_id)->first();
            if(!$message_list2){
                $message_list2 =  new MessageList();
                $message_list2->customer_id = $r->customer_id_2;
                $message_list2->customer_id_2 = $r->customer_id;
                $message_list2->save();
            }
            $message2 = $message_list2->message;
            if($message2!=''){
                $message2 =  json_decode($message2);
            }

            $message2[] = [
                'author' => 'user2',
                'name' => $r->name,
                'createdAt' => $r->createdAt,
                'id' => $r->id,
                'status' => 'unseen',
                'text' => '',
                'size' => $r->size,
                'height' => $r->height,
                'width' => $r->width,
                'uri' => $r->uri,
                'type' => $r->type,
            ];

            $message2 =  json_encode($message2);

            $message_list2->message = $message2;
            $message_list2->last_message = 'Image file';
            $message_list2->send_type = 2;
            $message_list2->message_type = 1;
            $message_list2->read_status = 0;
            $message_list2->save();

            if($message_list2->customer_1_is == ''){
                $message_list2->customer_1_is = $customer_2->select_type;
                $message_list2->save();
            }
            if($message_list2->customer_2_is == ''){
                $message_list2->customer_2_is = $customer_1->select_type;
                $message_list2->save();

                if($customer_1->select_type==1){
                    $url_img = Storage::disk('public')->url('').$customer_1->profile_img_path.$customer_1->profile_img;
                    if($customer_1->profile_img==''){
                        $url_img = 'nopic';
                    }
                    $name = $customer_1->name;
                }else{
                    $store = Store::select('logo_path','logo','store_name')->where('customer_id',$customer_1->id)->first();
                    $url_img = Storage::disk('public')->url('').$store->logo_path.$store->logo;
                    $name = $store->store_name;
                }
                $message_list2->url_img = $url_img;
                $message_list2->name = $name;
                $message_list2->save();
            }




            // return response()->json([
            //     'message' =>  'ไม่พบข้อมูลของคุณ',
            //     'status' => 0,
            //     'data' => '',
            // ]);

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    // 'brands' => $brands,
                    // 'brands_store' => $brands_store,
                    // 'brands_new' => $brands_new,
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

     public function api_get_message(Request $r)
     {
        DB::beginTransaction();
        try
        {

            $message_list = MessageList::where('customer_id',$r->customer_id)->where('customer_id_2',$r->customer_id_2)->first();
            $message_list2 = MessageList::where('customer_id',$r->customer_id_2)->where('customer_id_2',$r->customer_id)->first();

            if($message_list2){
                $message2 =  json_decode($message_list2->message);
                $message_new2 = [];
                foreach($message2 as $m){
                    $status = $m->status;
                    if($m->author == 'user'){
                        $status = 'seen';
                    }
                    if($m->type == 'text'){
                        $message_new2[] = [
                        'author' => $m->author,
                        'createdAt' => $m->createdAt,
                        'id' => $m->id,
                        'status' => $status,
                        'text' => $m->text,
                        'type' => $m->type,
                    ];
                }else{
                        $message_new2[] = [
                            'author' => $m->author,
                            'createdAt' => $m->createdAt,
                            'id' => $m->id,
                            'status' => $status,
                            'name' => $m->name,
                            'type' => $m->type,
                            'size' => $m->size,
                            'height' => $m->height,
                            'width' => $m->width,
                            'uri' => $m->uri,
                            'type' => $m->type,
                        ];
                    }
                }
                $message_new2 =  json_encode($message_new2);
                $message_list2->message = $message_new2;
                $message_list2->save();
            }

            if($message_list){
                $message =  json_decode($message_list->message);
                $message_new = [];
                $last_user2_message_id = '';
                foreach($message as $m){
                    $status = $m->status;
                    if($m->author == 'user2'){
                        $status = 'seen';
                        $last_user2_message_id = $m->id;
                    }
                    if($m->type == 'text'){
                        $message_new[] = [
                            'author' => $m->author,
                            'createdAt' => $m->createdAt,
                            'id' => $m->id,
                            'status' => $status,
                            'text' => $m->text,
                            'type' => $m->type,
                        ];
                    }else{
                        $message_new[] = [
                            'author' => $m->author,
                            'createdAt' => $m->createdAt,
                            'id' => $m->id,
                            'status' => $status,
                            'name' => $m->name,
                            'type' => $m->type,
                            'size' => $m->size,
                            'height' => $m->height,
                            'width' => $m->width,
                            'uri' => $m->uri,
                            'type' => $m->type,
                        ];
                    }

                }
                $message_new =  json_encode($message_new);

                $message_list->message = $message_new;
                $message_list->last_user2_message_id = $last_user2_message_id;
                if($message_list->send_type == 2){
                    $message_list->read_status = 1;
                }
                $message_list->save();
                $message =  json_decode($message_list->message);
            }else{
                $message = [];
                $last_user2_message_id = 0;
            }

            // return response()->json([
            //     'message' =>  'ไม่พบข้อมูลของคุณ',
            //     'status' => 0,
            //     'data' => '',
            // ]);

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'message' => $message,
                    'last_user2_message_id' => $last_user2_message_id,
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

     public function api_get_message_list(Request $r)
     {
        DB::beginTransaction();
        try
        {

            $message_list = MessageList::where('customer_id',$r->customer_id)->orderBy('updated_at','desc')->get();
            // $

            // return response()->json([
            //     'message' =>  'ไม่พบข้อมูลของคุณ',
            //     'status' => 0,
            //     'data' => '',
            // ]);

            DB::commit();

            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'message_list' => $message_list,
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

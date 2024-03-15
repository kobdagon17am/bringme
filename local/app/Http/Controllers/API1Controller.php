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
use App\Models\StockPre;
use App\Models\StockItemsPre;
use App\Models\StockLotPre;
use App\Models\CustomerCartTracking;
use App\Models\CustomerCartTrackingItem;
use Carbon\Carbon;

class API1Controller extends Controller
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
    // public function api_rigister(Request $r)
    // {
    //     // dd($r->all());
    //     // $this->validate($request, [
    //     //     'name' => 'required|string|max:255',
    //     //     'email' => 'required|string|email|max:255|unique:users',
    //     //     'password' => 'required|string|min:6|confirmed',
    //     // ]);

        // DB::beginTransaction();
        // try
        // {

        // $check_email = Customer::select('email')->where('email',$r->email)->first();
        // if($check_email){
        //     return response()->json([
        //         'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
        //         'status' => 0,
        //         'data' => '',
        //     ]);
        // }else{

            // $customer = new Customer();
            // $customer->firstname = $r->firstname;
    //         $customer->lastname = $r->lastname;
    //         $customer->age = $r->age;
    //         $customer->tel = $r->tel;
    //         $customer->email = $r->email;
    //         $customer->username = $r->username;
    //         $customer->birthday = $r->birthday;
    //         $customer->address = $r->address;
    //         $customer->card_id = $r->card_id;
    //         $customer->password = Hash::make($r->password);
    //         $customer->data_type = $r->data_type;
    //         $customer->sex_type = $r->sex_type;
    //         if (!empty($r->card_img)) {
    //             if ($r->hasFile('card_img') != '') {
    //                 // File::delete(public_path() . '/images/profile/' . $profile->card_img);
    //                 $card_img = 'profile_'.date('YmdHis').".".$r->file('card_img')->getClientOriginalExtension();
    //                 $r->file('card_img')->move(public_path() . '/images/customer/card_img/', $card_img);
    //                 $customer->card_img = $card_img;
    //             }

    //         }
    //         $customer->save();

    //         if($r->data_type==2){
    //             $customer->adress_tax = $r->adress_tax;
    //             $customer->status_member_regis = 2;

    //             if (!empty($r->book_account_img)) {
    //                 if ($r->hasFile('book_account_img') != '') {
    //                     // File::delete(public_path() . '/images/profile/' . $profile->book_account_img);
    //                     $book_account_img = 'profile_'.date('YmdHis').".".$r->file('book_account_img')->getClientOriginalExtension();
    //                     $r->file('book_account_img')->move(public_path() . '/images/customer/book_account_img/', $book_account_img);
    //                     $customer->book_account_img = $book_account_img;
    //                 }

    //             }

    //         }

    //         $customer->select_data_type = $r->data_type;

    //         $customer->status = 0;
    //         $invite_number = str_pad($customer->id, 5, '0', STR_PAD_LEFT);
    //         $customer->invite_number = 'BF'.$invite_number.'A';
    //         $customer->invite_number_register = $r->invite_number_register;
    //         $customer->display_type = 2;
    //         $customer->save();

    //         if($r->activity_id!='' && $r->activity_id!=null && $r->activity_id!=',' && $r->activity_id!='0'){
    //             $activity_id = explode(',',$r->activity_id);
    //             $activity_price = explode(',',$r->activity_price);
    //             $activity_status = explode(',',$r->activity_status);
    //             foreach($activity_id as $key => $data){
    //                 if($data!=''){
    //                     $activity_data = ActivityType::select('id')->where('id',$data)->first();
    //                     if($activity_data){
    //                         $customerActivityType = new CustomerActivityType();
    //                         $customerActivityType->customer_id = $customer->id;
    //                         $customerActivityType->activity_type_id = $data;
    //                         $customerActivityType->price = $activity_price[$key];
    //                         $customerActivityType->status = $activity_status[$key];
    //                         $customerActivityType->save();
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();

            // return response()->json([
            //     'message' => 'ทำรายการสำเร็จ กรุณารอการยืนยันจากระบบเพื่อใช้งานผ่าน email',
            //     'status' => 1,
            //     'data' => $customer,
            // ]);

    //     }


    // }
    // catch (\Exception $e) {
    //     DB::rollback();
    // // return $e->getMessage();
    // return response()->json([
    //     'message' =>  $e->getMessage(),
    //     'status' => 0,
    //     'data' => '',
    // ]);
    // }
    // catch(\FatalThrowableError $e)
    // {
    //     DB::rollback();
    //     return response()->json([
    //         'message' =>  $e->getMessage(),
    //         'status' => 0,
    //         'data' => '',
    //     ]);
    // }

    // }

    public function api_customer_login(Request $r)
    {
        $customer = Customer::where('email',$r->email)
        ->whereIn('status',[1,2])
        ->first();
        // if(!$customer){
        //     $customer = Customer::where('name',$r->email)
        //     ->whereIn('status',[1,2])
        //     ->first();
        // }
        if(!$customer){
            $customer = Customer::where('tel',$r->email)
            ->whereIn('status',[1,2])
            ->first();
        }

        if($customer){
            if (Hash::check($r->password, $customer->password)) {

                // $customer->token = $r->token;
                // $customer->save();

                return response()->json([
                        'message' => 'success',
                        'status' => 1,
                        'data' => $customer,
                    ]);
                }else{
                    return response()->json([
                        'message' => 'รหัสผ่านไม่ถูกต้อง',
                    'status' => 0,
                    'data' => '',
                ]);
            }
        }else{
            $customer = Customer::where('email',$r->email)->whereIn('status',[0])->first();
            if($customer){
                return response()->json([
                    'message' => 'Email กำลังรอตรวจสอบการสมัครสมาชิก',
                    'status' => 0,
                    'data' => '',
                ]);
            }else{
                return response()->json([
                    'message' => 'ไม่พบผู้ใช้ในระบบ',
                    'status' => 0,
                    'data' => '',
                ]);
            }
        }

    }

    public function api_customer_register(Request $r)
    {
        DB::beginTransaction();
        try
            {
                $check_email = Customer::select('email')->where('email',$r->email)->first();
                if($check_email){
                    return response()->json([
                        'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                        'status' => 0,
                        'data' => '',
                    ]);
                }else{
                    $customer = new Customer();
                    $customer->name = $r->name;
                    $customer->email = $r->email;
                    $customer->birthday = $r->birthday;
                    $customer->tel = $r->tel;
                    $customer->firstname = $r->firstname;
                    $customer->password = Hash::make($r->password);
                    $customer->customer_type = 1;
                    $customer->select_type = 1;
                    $customer->status = 1;
                    $customer->save();
                }
                DB::commit();
                $customer = Customer::where('email',$r->email)->first();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => $customer,
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

    public function api_customer_profile_update(Request $r)
    {
        DB::beginTransaction();
        try
            {

                if(isset($r->type)){
                    $customer = Customer::where('id',$r->user_id)->first();
                    if($r->share_policy=='true'){
                        $customer->share_policy = 1;
                    }else{
                        $customer->share_policy = 0;
                    }
                    $customer->save();
                }else{
                    $check_email = Customer::select('id')->where('email',$r->email)->first();
                    if($check_email){
                        if($check_email->id != $r->user_id){
                            return response()->json([
                                'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                    }

                        $customer = Customer::where('id',$r->user_id)->first();
                        $customer->name = $r->name;
                        $customer->email = $r->email;
                        $customer->birthday = $r->birthday;
                        $customer->tel = $r->tel;
                        if($r->password!=''){
                            $customer->password = Hash::make($r->password);
                        }
                        // $customer->customer_type = 1;
                        // $customer->select_type = 1;
                        // $customer->status = 1;
                        $customer->save();

                        if($r->profile_img != ''){
                            $image_64 = $r->profile_img;
                            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                            $image = str_replace($replace, '', $image_64);
                            $image = str_replace(' ', '+', $image);
                            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                            Storage::disk('public')->put('uploads/profile/' . $imageName, base64_decode($image));
                            $customer->profile_img_path = 'uploads/profile/';
                            $customer->profile_img = $imageName;
                            $customer->save();
                        }
                }

                DB::commit();
                $customer = Customer::where('id',$r->user_id)->first();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => $customer,
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

    public function api_get_user(Request $r)
    {
        $user = Customer::where('id',$r->user_id)->first();
        $url_img = Storage::disk('public')->url('');
        $following_store_numbers = DB::table('store_following')->select('id')->where('customer_id',$r->user_id)->where('status',1)->get();
        $following_store_number = count($following_store_numbers);
        if($following_store_number==null){
            $following_store_number = '0';
        }

        if($user){
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $user,
                'url_img' => $url_img,
                'following_store_number' => $following_store_number,
            ]);
        }else{
            return response()->json([
                'message' => 'ไม่พบข้อมูลผู้ใช้',
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_get_provinces(Request $r)
    {
        $data = DB::table('provinces')->orderBy('name_th')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $data,
            ]);
    }

    public function api_get_amphures(Request $r)
    {
        $data = DB::table('amphures')->where('province_id',$r->province_id)->orderBy('name_th')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $data,
            ]);
    }

    // public function api_get_districts(Request $r)
    // {
    //     $data = DB::table('districts')->where('amphure_id',$r->amphure_id)->orderBy('name_th')->get();
    //         return response()->json([
    //             'message' => 'สำเร็จ',
    //             'status' => 1,
    //             'data' => $data,
    //         ]);
    // }

    public function api_get_zipcode(Request $r)
    {
        $data = DB::table('districts')->where('id',$r->district_id)->first();
        if($data){
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $data->zip_code,
            ]);
        }
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => '',
            ]);
    }

    public function api_get_dataset(Request $r)
    {
        $category = DB::table('category')->orderBy('name_th','asc')->get();
        $brands = DB::table('brands')->where('has_store',0)->orderBy('name_th','asc')->get();
        if(isset($r->user_id)){
            $store = DB::table('store')->select('brands_id')->where('customer_id',$r->user_id)->first();
            if($store){
                $brands_store = DB::table('brands')->where('id',$store->brands_id)->orderBy('name_th','asc')->get();
            }else{
                $brands_store = DB::table('brands')->where('id',0)->orderBy('name_th','asc')->get();
            }
        }else{
            $brands_store = DB::table('brands')->where('id',0)->orderBy('name_th','asc')->get();
        }
        $bank = DB::table('bank')->orderBy('txt_desc','asc')->get();
        $dataset_pay_type = DB::table('dataset_pay_type')->get();
        $storage_method = DB::table('storage_method')->get();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'category' => $category,
                    'brands' => $brands,
                    'brands_store' => $brands_store,
                    'bank' => $bank,
                    'dataset_pay_type' => $dataset_pay_type,
                    'storage_method' => $storage_method,
                ],
            ]);
    }

    public function api_register_store(Request $r)
    {
        DB::beginTransaction();
        try
            {

                $check_email = Customer::select('email')->where('email',$r->email)->first();
                $check_phone = Customer::select('tel')->where('tel',$r->tel)->first();
                if(isset($r->user_id)){
                    if($r->user_id==0){
                        if($check_email){
                            return response()->json([
                                'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }else{

                            if($check_phone){
                                return response()->json([
                                    'message' => 'เบอร์โทร นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                                    'status' => 0,
                                    'data' => '',
                                ]);
                            }

                            $customer = new Customer();
                            $customer->name = $r->user_name;
                            $customer->email = $r->email;
                            $customer->password = Hash::make($r->password);
                        }
                    }else{
                        $customer = Customer::where('id',$r->user_id)->first();
                        if(!$customer){
                            return response()->json([
                                'message' => 'ไม่พบผู้ใช้ในระบบ',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                    }
                }else{
                    if($check_email){
                        return response()->json([
                            'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                            'status' => 0,
                            'data' => '',
                        ]);
                    }else{

                        if($check_phone){
                            return response()->json([
                                'message' => 'เบอร์โทร นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }

                        $customer = new Customer();
                        $customer->name = $r->user_name;
                        $customer->email = $r->email;
                        $customer->password = Hash::make($r->password);
                    }
                }

                $customer->birthday = $r->birthday;
                $customer->tel = $r->tel;
                $customer->customer_type = 2;
                $customer->select_type = 1;
                $customer->status = 1;
                $customer->address = $r->address;
                $customer->province_id = $r->province_id;
                $customer->amphures_id = $r->amphures_id;
                $customer->district_id = $r->district_id;
                $customer->zipcode = $r->zipcode;
                $customer->firstname = $r->name;
                // $customer->lat = $r->birthday;
                // $customer->long = $r->birthday;
                //
                $customer->save();

                $brand = Brands::where('name_th',$r->brands)->first();
                if(!$brand){
                    $brand = new Brands();
                    $brand->name_th = $r->brands;
                    $brand->name_en = $r->brands;
                    $brand->has_store = 1;
                    $brand->save();
                }
                $store = new Store();
                $store->customer_id = $customer->id;
                $store->brands_id = $brand->id;
                $store->store_name = $r->brands;
                $store->category_id = $customer->category_id;
                $store->brand_product_detail = $r->brand_product_detail;
                $store->product_price = $r->product_price;
                $store->storage_method_id = $r->storage_method_id;
                $store->shelf_lift = $r->shelf_lift;
                $store->qty_sku = $r->qty_sku;
                $store->shipping_date = $r->shipping_date;
                $store->social = $r->social;
                $store->store_type = $r->store_type;

                if($r->store_type == '1'){
                    $store->address = $r->address;
                    $store->province_id = $r->province_id;
                    $store->amphures_id = $r->amphures_id;
                    $store->district_id = $r->district_id;
                    $store->zipcode = $r->zipcode;
                }else{
                    $store->address = $r->address2;
                    $store->province_id = $r->province_id2;
                    $store->amphures_id = $r->amphures_id2;
                    $store->district_id = $r->district_id2;
                    $store->zipcode = $r->zipcode2;
                }

                $store->bank_id = $r->bank_id;
                $store->bank_account_name = $r->bank_account_name;
                $store->bank_account_number = $r->bank_account_number;
                $store->save();

                if($r->product_ex_img!=''){
                    $image_64 = $r->product_ex_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->product_ex_img_path = 'store/'.$store->id.'/';
                    $store->product_ex_img = $imageName;
                    $store->save();
                }

                if($r->product_pack_img!=''){
                    $image_64 = $r->product_pack_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->product_pack_img_path = 'store/'.$store->id.'/';
                    $store->product_pack_img = $imageName;
                    $store->save();
                }

                if($r->certificate!=''){
                    $image_64 = $r->certificate;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->certificate_path = 'store/'.$store->id.'/';
                    $store->certificate = $imageName;
                    $store->save();
                }

                if($r->bank_img!=''){
                    $image_64 = $r->bank_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->bank_img_path = 'store/'.$store->id.'/';
                    $store->bank_img = $imageName;
                    $store->save();
                }

                if($r->id_card_img!=''){
                    $image_64 = $r->id_card_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->id_card_img_path = 'store/'.$store->id.'/';
                    $store->id_card_img = $imageName;
                    $store->save();
                }

                if($r->company_img!=''){
                    $image_64 = $r->company_img;
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                    Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                    $store->company_img_path = 'store/'.$store->id.'/';
                    $store->company_img = $imageName;
                    $store->save();
                }

                DB::table('customer_acc')->insert([
                    'store_id' => $store->id,
                    'bank_id' => $r->bank_id,
                    'acc_name' => $r->bank_account_name,
                    'acc_number' => $r->bank_account_number,
                    'acc_path' => $store->bank_img_path,
                    'acc_img' => $store->bank_img,
                    'used' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                DB::commit();
                $customer = Customer::where('email',$r->email)->first();
                $store = Store::where('id',$store->id)->first();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => [
                        'customer' => $customer,
                        'store' => $store,
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

    public function api_change_select_type(Request $r)
    {
        DB::beginTransaction();
        try
            {
                $customer = Customer::where('id',$r->user_id)->first();
                if($customer->select_type==1){
                    if($customer->approve_store!=1){
                        return response()->json([
                            'message' =>  'กรุณารอการยืนยันจากระบบก่อนใช้งานร้านค้า',
                            'status' => 0,
                            'data' => '',
                        ]);
                    }
                    $customer->select_type = 2;
                }else{
                    $customer->select_type = 1;
                }
                $customer->save();

                DB::commit();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => $customer,
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

    public function api_forget_password(Request $r){
        DB::beginTransaction();
        try
        {
            $resetLink = url('reset_password').'/'.base64_encode($r->input('email'));
            Mail::to($r->input('email'))->send(new SendMail($resetLink));
            return response()->json([
                'message' =>  'Send mail successful.',
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

    public function api_reset_password(Request $r){
        DB::beginTransaction();
        try
        {
            if($r->password == $r->re_password){
                $email = base64_decode($r->token);
                $data['password'] = Hash::make($r->password);
                User::where('email')->update($data);
                return response()->json([
                    'message' =>  'Reset Password Successful.',
                    'status' => 1,
                    'data' => '',
                ]);
            }else{
                return response()->json([
                    'message' =>  'Reset Password Failed. Password is not Currect.',
                    'status' => 'failed',
                    'data' => '',
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

    public function api_get_flashsale(){
        DB::beginTransaction();
        try
        {
            $product_flashsale = Products::get();
            if(!empty($product_flashsale)){
                $data['flashsale'] = $product_flashsale;
                return response()->json([
                    'message' =>  'Reset Password Successful.',
                    'status' => 1,
                    'data' => $data,
                ]);
            }else{
                return response()->json([
                    'message' =>  'Empty Product Promotion.',
                    'status' => 'failed',
                    'data' => '',
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

    public function api_customer_new_address(Request $request){
        // dd($request->input());
        DB::beginTransaction();
        try
        {
            if($request->default_active=='Y'){
                $customer_address = DB::table('customer_address')->where('customer_id',$request->customer_id)->update([
                    'default_active' => 'N'
                ]);
            }
            $customer_address = new Customer_address();
            $customer_address->customer_id = $request->customer_id;
            $customer_address->name = $request->name;
            $customer_address->tel = $request->tel;
            $customer_address->address_number = $request->address_number;
            $customer_address->province_id = $request->province_id;
            $customer_address->amphures_id = $request->amphures_id;
            $customer_address->district_id = $request->district_id;
            $customer_address->zipcode = $request->zipcode;
            $customer_address->address_lat = $request->address_lat;
            $customer_address->address_long = $request->address_long;
            $customer_address->default_active = $request->default_active;
            $customer_address->created_at = date('Y-m-d H:i:s');
            $customer_address->save();

            if($request->default_active=='Y'){
                CustomerCart::where('customer_id',$request->customer_id)->where('status',0)->update([
                    'customer_address_id'=>$customer_address->id
                ]);
            }

            DB::commit();

            return response()->json([
                'message' =>  'Insert New Address Successful.',
                'status' => 1,
                'data' => $customer_address,
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

    public function api_get_category(){
        DB::beginTransaction();
        try
        {
            $category = Category::get();
            return response()->json([
                'message' =>  'Get Category Successful.',
                'status' => 1,
                'data' => $category,
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

    public function api_get_brand(){
        DB::beginTransaction();
        try
        {
            $brand = Brands::get();
            return response()->json([
                'message' =>  'Get Brands Successful.',
                'status' => 1,
                'data' => $brand,
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

    public function api_get_product_filter(Request $request){
        DB::beginTransaction();
        try
        {
            $raw_product = Products::where('qty','>',0);
            if(!empty($request->category_id)){
                $raw_product->where('category_id',$request->category_id);
            }
            if(!empty($request->brands_id)){
                $raw_product->where('brands_id',$request->brands_id);
            }
            $product = $raw_product->get();
            return response()->json([
                'message' =>  'Filter Product Successful.',
                'status' => 1,
                'data' => $product,
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

    public function api_add_cart(Request $r){
        DB::beginTransaction();
        try
        {
            $cart = CustomerCart::where('customer_id',$r->user_id)->where('status',0)->first();
            if(!$cart){
                $cart = new CustomerCart();
            }
            $cart->customer_id = $r->user_id;

            $cart->shipping_type_id = 1;
            $customer_address = Customer_address::
            select('customer_address.id')
            ->where('customer_address.customer_id',$r->user_id)
            ->where('customer_address.default_active','Y')
            ->first();
            if($customer_address){
                $cart->customer_address_id = $customer_address->id;
            }
            $cart->total_price = 0;
            $cart->shipping_price = 0;
            $cart->grand_total = 0;
            $cart->has_promotion = 0;
            $cart->discount_price = 0;
            $cart->action_date = date('Y-m-d');
            $cart->save();

            $product_datail = Products::where('id',$r->product_id)->first();
            if( $product_datail){
                if(isset($r->products_option_2_items)){
                    $product = CustomerCartProduct::where('pre_order_status',0)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->where('products_option_2_items_id',$r->products_option_2_items)->first();
                }else{
                    if(isset($r->customer_cart_product_id)){
                        $product = CustomerCartProduct::where('id',$r->customer_cart_product_id)->first();
                    }else{
                        $product = CustomerCartProduct::where('pre_order_status',0)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();
                    }

                }


                if($product){
                    if(isset($r->remove_one)){
                        if($r->remove_one == 1){
                            $product->qty = 0;
                            $product->save();
                        }else{
                            $product->qty = 0;
                            $product->save();
                        }
                    }
                }
                // if($product_datail->preorder_active == 0){
                    $stock_lot = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                    ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
                    $qty_booking_sum = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                    ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->sum('qty_booking');
                // }else{
                //     $stock_lot = StockLot::where('product_id',$r->product_id)->first();
                //     $qty_booking_sum = StockLot::where('product_id',$r->product_id)->sum('qty_booking');
                // }

                // if($product_datail->preorder_active == 0){
                    if(!$stock_lot){
                        return response()->json([
                            'message' =>  'จำนวนสินค้าหมดแล้ว',
                            'status' => 0,
                            'data' => '',
                        ]);
                    // }else{
                    //     if($qty_booking_sum<$r->qty){
                    //         return response()->json([
                    //             'message' =>  'จำนวนสินค้าไม่เพียงพอ',
                    //             'status' => 0,
                    //             'data' => '',
                    //         ]);
                    //     }
                    // }
                }
                $stock_items = StockItems::where('product_id',$r->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                if($product){
                    // ตรวจว่าในตะกร้าเกินหรือยัง
                    // if($product_datail->preorder_active == 0){
                        if(($r->qty+$product->qty) > $qty_booking_sum){
                            return response()->json([
                                'message' =>  'ท่านหยิบสินค้าเกินจำนวนแล้ว',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                    // }

                    $product->price = $stock_items->price;
                    if($r->type=='new'){
                        $product->total_price = ($stock_items->price*$r->qty);
                        $product->qty = $r->qty;
                    }else{
                        $product->total_price = ($stock_items->price*($r->qty+$product->qty));
                        $product->qty = ($r->qty+$product->qty);
                    }

                    $product->save();

                    if($r->qty == 0){
                        if(isset($r->products_option_2_items)){
                            CustomerCartProduct::where('pre_order_status',0)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->where('products_option_2_items_id',$r->products_option_2_items)->delete();
                        }else{
                            if(isset($r->customer_cart_product_id)){
                                CustomerCartProduct::where('pre_order_status',0)->where('id',$r->customer_cart_product_id)->delete();
                            }else{
                                CustomerCartProduct::where('pre_order_status',0)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->delete();
                            }

                        }
                    }

                }else{
                    $product = new CustomerCartProduct();
                    $product->customer_cart_id = $cart->id;
                    $product->pre_order_status = 0;
                    $product->customer_id = $r->user_id;
                    $product->product_id = $r->product_id;
                    $product->store_id = $product_datail->store_id;
                    $product->price = $stock_items->price;
                    $product->total_price = ($stock_items->price*$r->qty);
                    $product->qty = $r->qty;
                    if(isset($r->products_option_2_items)){
                        $product->products_option_2_items_id = $r->products_option_2_items;
                    }else{
                        $products_option_2_items_id = DB::table('products_option_2_items')->select('id')->where('product_id',$r->product_id)->first();
                        $product->products_option_2_items_id = $products_option_2_items_id->id;
                    }
                    $product->save();

                }

                $product_cart = CustomerCartProduct::where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->get();
                $total_price = 0;
                foreach($product_cart as $pro){
                    // $pro_detail = Products::where('id',$pro->product_id)->first();
                    // if($pro_detail){
                        $total_price += $pro->total_price;
                    // }
                }
                $cart->total_price = $total_price;
                $cart->grand_total = $total_price;
                $cart->save();

            }else{
                return response()->json([
                    'message' =>  'ไม่พบสินค้าที่เลือก',
                    'status' => 0,
                    'data' => '',
                ]);
            }


            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
                    'product_cart' => $product_cart,
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

    public function api_add_cart_pre(Request $r){
        DB::beginTransaction();
        try
        {
            $products_option_2_items = DB::table('products_option_2_items')->select('id','product_id','products_item_pre_id','price','qty')->where('id',$r->products_option_2_items)->first();
            // $product_preorder = ProductsItem::where('product_id',$r->product_id)->where('preorder_date_cut_off','>',date('Y-m-d'))->where('is_preorder',1)->where('transfer_status',1)->first();
            if($products_option_2_items){
                $product_preorder = ProductsItem::where('product_id',$r->product_id)->where('id',$products_option_2_items->products_item_pre_id)->first();
                if(!$product_preorder){
                    return response()->json([
                        'message' =>  'สินค้านี้ปิดรับแล้ว',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
            }

            $cart = CustomerCart::where('customer_id',$r->user_id)->where('status',0)->first();
            if(!$cart){
                $cart = new CustomerCart();
            }
            $cart->customer_id = $r->user_id;

            $cart->shipping_type_id = 1;
            $customer_address = Customer_address::
            select('customer_address.id')
            ->where('customer_address.customer_id',$r->user_id)
            ->where('customer_address.default_active','Y')
            ->first();
            if($customer_address){
                $cart->customer_address_id = $customer_address->id;
            }
            $cart->total_price = 0;
            $cart->shipping_price = 0;
            $cart->grand_total = 0;
            $cart->has_promotion = 0;
            $cart->discount_price = 0;
            $cart->action_date = date('Y-m-d');
            $cart->save();

            $product_datail = Products::where('id',$r->product_id)->first();
            if( $product_datail){
                if(isset($r->products_option_2_items)){
                    $product = CustomerCartProduct::where('pre_order_status',1)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->where('products_option_2_items_id',$r->products_option_2_items)->first();
                }else{
                    if(isset($r->customer_cart_product_id)){
                        $product = CustomerCartProduct::where('pre_order_status',1)->where('id',$r->customer_cart_product_id)->first();
                    }else{
                        $product = CustomerCartProduct::where('pre_order_status',1)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();
                    }

                }

                if($product){
                    if(isset($r->remove_one)){
                        if($r->remove_one == 1){
                            $product->qty = 0;
                            $product->save();
                        }else{
                            $product->qty = 0;
                            $product->save();
                        }
                    }
                }
                   $stock_lot = StockLotPre::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('cut_off',0)->first();
                   $stock_items = StockItemsPre::where('product_id',$r->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                   if($product){

                    $product->price = $stock_items->price;
                    if($r->type=='new'){
                        $product->total_price = ($stock_items->price*$r->qty);
                        $product->qty = $r->qty;
                    }else{
                        $product->total_price = ($stock_items->price*($r->qty+$product->qty));
                        $product->qty = ($r->qty+$product->qty);
                    }

                    $product->save();

                    if($r->qty == 0){
                        if(isset($r->products_option_2_items)){
                            CustomerCartProduct::where('pre_order_status',1)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->where('products_option_2_items_id',$r->products_option_2_items)->delete();
                        }else{
                            if(isset($r->customer_cart_product_id)){
                                CustomerCartProduct::where('id',$r->customer_cart_product_id)->delete();
                            }else{
                                CustomerCartProduct::where('pre_order_status',1)->where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->delete();
                            }
                        }
                    }

                }else{
                    $product = new CustomerCartProduct();
                    $product->pre_order_status = 1;
                    $product->pre_order_shipping_date = $stock_lot->lot_expired_date;
                    $product->customer_cart_id = $cart->id;
                    $product->customer_id = $r->user_id;
                    $product->product_id = $r->product_id;
                    $product->store_id = $product_datail->store_id;
                    $product->price = $stock_items->price;
                    $product->total_price = ($stock_items->price*$r->qty);
                    $product->qty = $r->qty;
                    if(isset($r->products_option_2_items)){
                        $product->products_option_2_items_id = $r->products_option_2_items;
                    }else{
                        $products_option_2_items_id = DB::table('products_option_2_items')->select('id')->where('product_id',$r->product_id)->first();
                        $product->products_option_2_items_id = $products_option_2_items_id->id;
                    }
                    $product->save();

                }

                $product_cart = CustomerCartProduct::where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->get();
                $total_price = 0;
                foreach($product_cart as $pro){
                    // $pro_detail = Products::where('id',$pro->product_id)->first();
                    // if($pro_detail){
                        $total_price += $pro->total_price;
                    // }
                }
                $cart->total_price = $total_price;
                $cart->grand_total = $total_price;
                $cart->save();

            }else{
                return response()->json([
                    'message' =>  'ไม่พบสินค้าที่เลือก',
                    'status' => 0,
                    'data' => '',
                ]);
            }


            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
                    'product_cart' => $product_cart,
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

    public function api_get_home_page(Request $r)
    {
            // $product_good_sale = Products::where('approve_status',1)
            // ->where('display_status',1)
            // ->orderBy('sale_number','desc')
            // ->inRandomOrder()->get();

            $product_all = Products::select('id')->where('products.display_status',1)->get();
            $p_arr_not = [];
            foreach($product_all as $p){
                $qty_booking_sum = StockLot::where('product_id',$p->id)->where('lot_expired_date','>',date('Y-m-d'))
                ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->sum('qty_booking');

                if($qty_booking_sum < 1){
                    array_push($p_arr_not,$p->id);
                }
            }

            $product_good_sale = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
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
            ->whereNotIn('products.id',$p_arr_not)
            ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

            // $product_new = Products::where('approve_status',1)
            // ->where('display_status',1)
            // // ->orderBy('updated_at','desc')
            // ->inRandomOrder()->get();

            $product_new = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'store.logo_path','store.logo',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->whereNotIn('products.id',$p_arr_not)
            // ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

            // $product_pro = Products::where('approve_status',1)
            // ->where('display_status',1)
            // ->orderBy('updated_at','desc')
            // ->where('id',0)
            // ->inRandomOrder()->get();

            $product_pro = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'store.logo_path','store.logo',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->where('products.id',0)
            ->orderBy('products.updated_at','desc')
            ->inRandomOrder()->get();

            // $product_recome = Products::where('approve_status',1)
            // ->where('display_status',1)
            // ->orderBy('updated_at','desc')
            // // ->where('id',0)
            // ->inRandomOrder()->get();

            $product_recome = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'store.logo_path','store.logo',
            'products_gallery.name as gal_name',
            )
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->whereNotIn('products.id',$p_arr_not)
            ->orderBy('products.updated_at','desc')
            ->inRandomOrder()->get();

            $address = 'ยังไม่ระบุสถานที่จัดส่ง';
            $customer = [];
            if($r->user_id!=0){
                $customer_address = Customer_address::
                select('customer_address.*','customer_address.district_id as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
                // ->join('districts','districts.id','customer_address.district_id')
                ->join('amphures','amphures.id','customer_address.amphures_id')
                ->join('provinces','provinces.id','customer_address.province_id')
                ->where('customer_id',$r->user_id)->where('default_active','Y')->first();
                if($customer_address){
                    $address = $customer_address->address_number.' '.$customer_address->district_id.' '.$customer_address->amphures_name.' '.$customer_address->provinces_name.' '.$customer_address->zipcode;
                }
                $customer = Customer::where('id',$r->user_id)->get();
            }

            $category = Category::where('status',1)->orderBy('name_th','asc')->get();
            $cnum = count($category)/2;
            $c_arr1 = [];
            $c_arr2 = [];
            foreach($category as $key => $c){
                if(($key+1) <= $cnum){
                    array_push($c_arr1, $c->id);
                }else{
                    array_push($c_arr2, $c->id);
                }
            }

            $category1 = Category::where('status',1)->whereIn('id',$c_arr1)->orderBy('name_th','asc')->get();
            $category2 = Category::where('status',1)->whereIn('id',$c_arr2)->orderBy('name_th','asc')->get();
            $url_img = Storage::disk('public')->url('');

            // ตรวจว่าพรีออเดอร์หมดยัง
            $product_all_pre = Products::select('id')->where('products.display_status',1)->where('preorder_active',1)->get();
            $p_arr_not = [];
           foreach($product_all_pre as $arr){
            $product_item_pe_arr = ProductsItem::select('id')->where('product_id',$arr->id)->where('preorder_date_cut_off','>',date('Y-m-d'))->where('is_preorder',1)->where('transfer_status',1)->pluck('id')->toArray();
            $stock_lot_pre = StockLotPre::select('id','lot_expired_date')->whereIn('products_item_id',$product_item_pe_arr)->where('product_id',$arr->id)->where('lot_expired_date','>',date('Y-m-d'))->where('cut_off',0)->first();
            if(!$stock_lot_pre){
                array_push($p_arr_not,$arr->id);
            }
        }

            $product_preorder = Products::select('products.*',
            // 'products_item.transfer_status',
            // 'products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'store.logo_path','store.logo',
            )
            // ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            // ->where('products_item.approve_status',1)
            // ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            // ->whereNotIn('products.id',$p_arr_not)
            ->where('products.preorder_active',1)
            ->whereNotIn('products.id',$p_arr_not)
            ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'product_good_sale' => $product_good_sale,
                    'product_new' => $product_new,
                    'product_pro' => $product_pro,
                    'product_recome' => $product_recome,
                    'address' => $address,
                    'url_img' => $url_img,
                    'category1' => $category1,
                    'category2' => $category2,
                    'product_preorder' => $product_preorder,
                    'customer' => $customer,
                ],
            ]);
    }

    public function api_get_product_detail(Request $r)
    {
        // if(isset($r->user_id)){ stock_items_pre
        //     if(){

        //     }
        // }
        $product_detail = Products::where('id',$r->product_id)->first();
        $product_detail->visitor_number = $product_detail->visitor_number+1;
        $product_detail->save();

        if($product_detail){
            $store = Store::where('id',$product_detail->store_id)->first();
            $customer = Customer::where('id',$store->customer_id)->first();

            $product_good_sale = Products::select(
            'products.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',)
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('products.approve_status',1)
            ->where('products.store_id',$product_detail->store_id)
            ->where('products.display_status',1)
            ->orderBy('products.sale_number','desc')
            ->get();

            $product_your_like = Products::select(
            'products.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',)
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('products.approve_status',1)
            ->where('products.display_status',1)
            ->orderBy('products.updated_at','desc')
            ->get();

            $product_gallery = ProductsGallery::where('product_id',$r->product_id)->orderBy('use_profile','desc')->get();
            $url_img = Storage::disk('public')->url('');
            $stock_lot = StockLot::select('lot_expired_date','product_expired_date')->where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
            if($stock_lot){
                $lot_expired_date = date('d/m/Y', strtotime($stock_lot->lot_expired_date));
                $product_expired_date = date('d/m/Y', strtotime($stock_lot->product_expired_date));
            }else{
                $lot_expired_date = '';
                $product_expired_date = '';
            }
            $stock_lot_all = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();
            $products_comment = ProductsComment::
            select('products_comment.*','customer.name as cus_name')
            ->join('customer','customer.id','products_comment.customer_id')
            ->where('products_comment.product_id',$r->product_id)
            ->orderBy('products_comment.created_at','desc')->get();

            $stock_lot_all_arr = StockLot::select('id')->where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->pluck('id')->toArray();
            $stock_items_sum = StockItems::select('qty_booking')->whereIn('stock_lot_id',$stock_lot_all_arr)->where('product_id',$r->product_id)->sum('qty_booking');

            $store->visitor_number = $store->visitor_number+1;
            $store->save();

            if(isset($r->user_id)){
                $favorite_customer = DB::table('favorite_customer')->select('status')->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();
                if($favorite_customer){
                    $favorite = $favorite_customer->status;
                }else{
                    $favorite = 0;
                }
            }else{
                $favorite = 0;
            }

            $brand = Brands::where('id',$product_detail->brands_id)->first();
            $category = Category::where('id',$product_detail->category_id)->first();
            $storage_method = DB::table('storage_method')->where('id',$product_detail->storage_method_id)->first();

            $stock_items = StockItems::whereIn('stock_lot_id',$stock_lot_all_arr)->where('product_id',$r->product_id)->get();
            $stock_items_pre = [];
            if($product_detail->preorder_active=='1'){
                // $stock_items_pre = StockItems::where('product_id',$r->product_id)->get();
                $product_item_pe_arr = ProductsItem::select('id')->where('product_id',$r->product_id)->where('is_preorder',1)->where('transfer_status',1)->pluck('id')->toArray();
                $stock_lot_pre = StockLotPre::select('id','lot_expired_date')->whereIn('products_item_id',$product_item_pe_arr)->where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                ->where('cut_off',0)
                ->first();
                if($stock_lot_pre){
                    $stock_items_pre = StockItemsPre::select('stock_lot_pre.lot_expired_date','stock_items_pre.*','products_item.preorder_date_bringme')
                    ->join('products_item','products_item.id','stock_items_pre.products_item_id')
                    ->join('stock_lot_pre','stock_lot_pre.id','stock_items_pre.stock_lot_id')
                    ->where('stock_items_pre.product_id',$r->product_id)
                    ->where('stock_items_pre.stock_lot_id',$stock_lot_pre->id)->get();
                }else{
                    $stock_items_pre = [];
                }
            }

            $stock_items_count = count($stock_items);
            $stock_items_count_pre = count($stock_items_pre);

            // $products_option_head1 = ProductsOptionHead::where('product_id',$r->product_id)->where('option_type',1)->first();
            // $products_option_head2 = ProductsOptionHead::where('product_id',$r->product_id)->where('option_type',2)->first();

            // $products_option_1 = ProductsOption1::where('product_id',$r->product_id)->get();
            // $products_option_2 = ProductsOption2::where('product_id',$r->product_id)->get();

            // $products_option_2_items = ProductsOption2Items::where('product_id',$r->product_id)->

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer' => [$customer],
                    'store' => $store,
                    'product_good_sale' => $product_good_sale,
                    'product_your_like' => $product_your_like,
                    'product_detail' => $product_detail,
                    'product_gallery' => $product_gallery,
                    'url_img' => $url_img,
                    'lot_expired_date' => $lot_expired_date,
                    'stock_lot_all' => $stock_lot_all,
                    'products_comment' => $products_comment,
                    'stock_items_sum' => $stock_items_sum,
                    'comment_number' => count($products_comment),
                    'favorite' => $favorite,
                    'brand' => $brand,
                    'stock_items' => $stock_items,
                    'stock_items_pre' => $stock_items_pre,
                    'stock_items_count' => $stock_items_count,
                    'stock_items_count_pre' => $stock_items_count_pre,
                    'category' => $category,
                    'storage_method' => $storage_method,
                    'product_expired_date' => $product_expired_date,
                    // 'products_option_head1' => $products_option_head1,
                    // 'products_option_head2' => $products_option_head2,
                    // 'products_option_1' => $products_option_1,
                    // 'products_option_2' => $products_option_2,
                ],
            ]);
        }else{
            return response()->json([
                'message' =>  'ไม่พบสินค้าที่เลือก',
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_get_cart_wait(Request $r)
    {
        $cart = CustomerCart::where('customer_id',$r->user_id)->where('status',0)->first();
        $product_qty = 0;
        $product_qty_all = 0;
        $cold = 0;
        if($cart){
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products.storage_method_id',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.pre_order_status',0)
            ->where('customer_cart_product.customer_cart_id',$cart->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            // เช็คจำนวนอีกครั้ง
            foreach($products as $pro){
                $qty_booking_sum = StockLot::where('product_id',$pro->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->sum('qty_booking');
                if($qty_booking_sum<$pro->qty){
                    $update_cart_product = CustomerCartProduct::where('pre_order_status',0)->where('id',$pro->id)->first();
                    $update_cart_product->qty = $qty_booking_sum;
                    $update_cart_product->save();
                    if($qty_booking_sum < 1){
                        CustomerCartProduct::where('pre_order_status',0)->where('id',$pro->id)->delete();
                    }
                }
            }

            $products_pre = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products.storage_method_id',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.pre_order_status',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            // เช็คจำนวนอีกครั้ง

            foreach($products_pre as $pro){
                $product_preorder = ProductsItem::where('product_id',$pro->product_id)->where('preorder_date_cut_off','>',date('Y-m-d'))->where('is_preorder',1)->where('transfer_status',1)->first();
                if(!$product_preorder){
                    CustomerCartProduct::where('pre_order_status',1)->where('id',$pro->id)->delete();
                }
            }

            // เพิ่ม option
            $products = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
            'customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products.storage_method_id',
            'products_option_2_items.name_th as items_name',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('products_option_2_items','products_option_2_items.id','customer_cart_product.products_option_2_items_id')
            ->where('products_gallery.use_profile',1)
            ->where('customer_cart_product.customer_cart_id',$cart->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            // เช็คจัดส่งเย็น
            foreach($products as $pro){
                $product_qty_all++;
                if($pro->storage_method_id == 2){
                    $cold++;
                }
            }

            $customer_address = Customer_address::
            select('customer_address.*','customer_address.district_id as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
            // ->join('districts','districts.id','customer_address.district_id')
            ->join('amphures','amphures.id','customer_address.amphures_id')
            ->join('provinces','provinces.id','customer_address.province_id')
            ->where('customer_address.id',$cart->customer_address_id)->first();
            if(!$customer_address){
                $customer_address = '';
            }

            if(isset($r->product_id)){
                $products_one = CustomerCartProduct::select('customer_cart_product.*','products.name_th as product_name',
                'customer_cart_product.price as product_price',
                'brands.name_th as brand_name',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                )
                ->join('products','products.id','customer_cart_product.product_id')
                ->join('brands','brands.id','products.brands_id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->where('products_gallery.use_profile',1)
                ->where('customer_cart_product.customer_cart_id',$cart->id)
                ->where('customer_cart_product.customer_id',$r->user_id)
                ->where('customer_cart_product.product_id',$r->product_id)
                ->get();
                $product_qty = 0;
                foreach($products_one as $pro){
                    $product_qty+=$pro->qty;
                }
            }

            $url_img = Storage::disk('public')->url('');
            if($cold>0){
              $arr_type_not = [1];
            }else{
              $arr_type_not = [2];
            }
            $shipping_type = DB::table('shipping_type')
            // ->whereNotIn('type',$arr_type_not)
            ->where('display',1)->get();

            if(date("Y-m-d H:i:s") < date("Y-m-d".' 08:00:00')){
                $period = '1';
            }else{
                if(date("Y-m-d H:i:s") > date("Y-m-d".' 13:00:00')){
                    $period = '1';
                }else{
                    $period = '2';
                }
            }

            $payment_terms = DB::table('payment_terms')->first();

            $cart_pre = CustomerCart::where('customer_id',$r->user_id)
            ->where('status',2)
            ->where('shipping_type_id',4)
            ->where('pay_other_cart_id',null)
            ->where('pay_other_status',1)
            ->orderBy('id','desc')->get();

            $shipping_period = [];
            if(isset($r->shipping_type_id)){
                if($r->shipping_type_id==1 || $r->shipping_type_id==2 || $r->shipping_type_id==7 || $r->shipping_type_id==8 || $r->shipping_type_id==9 || $r->shipping_type_id==10){
                    $shipping_period = DB::table('shipping_period')->where('makesend_pickup_time','!=',0)->where('shipping_other',0)->where('status',1)->get();
                }
                if($r->shipping_type_id==3 || $r->shipping_type_id==4 || $r->shipping_type_id==5 || $r->shipping_type_id==6 || $r->shipping_type_id==7 || $r->shipping_type_id==8){
                    $shipping_period = DB::table('shipping_period')->where('makesend_pickup_time','==',0)->where('shipping_other',0)->where('status',1)->get();
                }
            }

            $shipping_period_pre = DB::table('shipping_period')->where('shipping_other',1)->where('status',1)->get();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'product_qty' => $product_qty,
                    'product_qty_all' => $product_qty_all,
                    'cart' => $cart,
                    'customer_address' => $customer_address,
                    'url_img' => $url_img,
                    'shipping_type' => $shipping_type,
                    'period' => $period,
                    'payment_terms' => $payment_terms,
                    'cart_pre' => $cart_pre,
                    'shipping_period' => $shipping_period,
                    'shipping_period_pre' => $shipping_period_pre,
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

    public function api_get_address_list(Request $r)
    {
        $customer_address = Customer_address::
        select('customer_address.*','customer_address.district_id as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
        // ->join('districts','districts.id','customer_address.district_id')
        ->join('amphures','amphures.id','customer_address.amphures_id')
        ->join('provinces','provinces.id','customer_address.province_id')
        ->where('customer_id',$r->user_id)->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer_address' => $customer_address,
                ],
            ]);
    }

    public function api_select_customer_address(Request $r)
    {
        $customer_address = DB::table('customer_address')->where('customer_id',$r->user_id)->update([
            'default_active' => 'N'
        ]);
        $customer_address = DB::table('customer_address')->where('customer_id',$r->user_id)->where('id',$r->address_id)->update([
            'default_active' => 'Y'
        ]);
        $customer_address = DB::table('customer_address')->where('customer_id',$r->user_id)->where('id',$r->address_id)->first();

        CustomerCart::where('customer_id',$r->user_id)->where('status',0)->update([
            'customer_address_id' => $r->address_id,
        ]);

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer_address' => $customer_address,
                ],
            ]);
    }

    public function api_pre_cart_purchase(Request $r){
        {
            $cart = CustomerCart::where('id',$r->cart_id)->first();
            if($cart){
                $customer = Customer::select('name')->where('id',$r->user_id)->first();
                $cart->cart_products_id_arr = $r->cart_products_id;
                $cart->save();

         // ตะกร้า pay_other_cart_id_arr total_price pay_other_status
         $cart->action_date = date('Y-m-d');
         $cart->pay_type = $r->pay_type;
         $cart->status = 0;
         $cart->order_number = 'BM'.date('Ym').str_pad($cart->id, 5, '0', STR_PAD_LEFT);
        if($r->shipping_date != ''){
            if($r->shipping_date <= date('Y-m-d')){
                $shipping_period = DB::table('shipping_period')->where('id',$r->period)->first();
                if($shipping_period->time_end < date('H:i:s')){
                    $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                    $date = $date->addDays(1);
                    $cart->shipping_date = $date;
                }else{
                    $cart->shipping_date = date('Y-m-d');
                }
            }else{
                $cart->shipping_date = $r->shipping_date;
            }
        }else{
            $shipping_period = DB::table('shipping_period')->where('id',$r->period)->first();
            if($shipping_period->time_end < date('H:i:s')){
                $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                $date = $date->addDays(1);
                $cart->shipping_date = $date;
            }else{
                $cart->shipping_date = date('Y-m-d');
            }
        }
         $cart->period = $r->period;
         $cart->customer_name = $customer->name;
         // เพิ่มมา
         $cart->shipping_price = $r->shipping_price_total;
         $cart->total_price = $r->product_total_price;
         $cart->grand_total = $r->all_price_total;
        //  ใส่ขนส่ง
         $shipping_name = DB::table('shipping_name')->where('id',1)->first();
         $cart->shipping_name_id = $shipping_name->id;
         $cart->shipping_name_name = $shipping_name->name;
        //

        $cart->pay_other_cart_id_arr = $r->pay_other_cart_id_arr;
        $cart->shipping_type_id = $r->shipping_type_id;

        $cart->pay_other_status = $r->shipping_other;

         $cart->save();

        // บันทึกที่อยู่

        // if($cart->pay_other_status==0){

            $customer_cart_address = CustomerCartAddress::where('customer_cart_id',$cart->id)->first();
            if(!$customer_cart_address){
                $customer_cart_address = new CustomerCartAddress();
            }
            $customer_cart_address->customer_id = $cart->customer_id;

            $customer_cart_address->customer_cart_id = $cart->id;
            $customer_cart_address->customer_address_id = $cart->customer_address_id;

            $address = Customer_address::where('id',$cart->customer_address_id)->first();

            $customer_cart_address->name = $address->name;
            $customer_cart_address->tel = $address->tel;
            $customer_cart_address->address_number = $address->address_number;
            $customer_cart_address->province_id = $address->province_id;
            $customer_cart_address->amphures_id = $address->amphures_id;
            $customer_cart_address->district_id = $address->district_id;
            $customer_cart_address->zipcode = $address->zipcode;
            $customer_cart_address->address_lat = $address->address_lat;
            $customer_cart_address->address_long = $address->address_long;
            $customer_cart_address->save();

        // }


        if($r->pay_other_cart_id_arr!=''){
            $pay_other_cart_id_arr = explode(',',$r->pay_other_cart_id_arr);
            foreach($pay_other_cart_id_arr as $c_arr){
                $cart_other = CustomerCart::where('id',$c_arr)->where('customer_id',$r->user_id)->where('pay_other_status',1)->first();
                $cart_other->pay_other_cart_id = $cart->id;
                // $cart_other->pay_status = 0;
                $cart_other->save();

                  // บันทึกที่อยู่
                $customer_cart_address_other = CustomerCartAddress::where('customer_cart_id',$cart_other->id)->first();
                if(!$customer_cart_address_other){
                    $customer_cart_address_other = new CustomerCartAddress();
                }
                $customer_cart_address_other->customer_id = $cart->customer_id;

                $customer_cart_address_other->customer_cart_id = $cart_other->id;
                $customer_cart_address_other->customer_address_id = $cart->customer_address_id;

                $address = Customer_address::where('id',$cart->customer_address_id)->first();

                $customer_cart_address_other->name = $address->name;
                $customer_cart_address_other->tel = $address->tel;
                $customer_cart_address_other->address_number = $address->address_number;
                $customer_cart_address_other->province_id = $address->province_id;
                $customer_cart_address_other->amphures_id = $address->amphures_id;
                $customer_cart_address_other->district_id = $address->district_id;
                $customer_cart_address_other->zipcode = $address->zipcode;
                $customer_cart_address_other->address_lat = $address->address_lat;
                $customer_cart_address_other->address_long = $address->address_long;
                $customer_cart_address_other->save();
            }
         }

                return response()->json([
                    'message' =>  'success',
                    'status' => 1,
                    'data' => '',
                ]);
            }else{
                return response()->json([
                    'message' =>  'ไม่พบข้อมูลสินค้า',
                    'status' => 0,
                    'data' => '',
                ]);
            }
        }
    }

    public function api_purchase_cart(Request $r){
        DB::beginTransaction();
        try
        {
            // cart_products_id cart_products_id shipping_type_id
            $cart = CustomerCart::where('customer_id',$r->user_id)->where('status',0)->where('id',$r->cart_id)->first();
            $customer = Customer::select('name')->where('id',$r->user_id)->first();
            if($cart){
                $cart->action_date = date('Y-m-d');
                $cart->pay_type = $r->pay_type;
                // 2 คือแนบสลิป
                if($r->pay_type==2){
                    $cart->status = 1;
                }elseif($r->pay_type==1){
                    $cart->status = 2;
                    if($r->pay_type==1){
                        $cart->cod = 1;
                    }
                }elseif($r->pay_type==3){
                    $cart->status = 1;
                }
                $cart->order_number = 'BM'.date('Ym').str_pad($cart->id, 5, '0', STR_PAD_LEFT);

                if($r->shipping_date != ''){
                    $cart->shipping_date =$r->shipping_date;
                }else{
                    $cart->shipping_date = date('Y-m-d');
                }

                $cart->pay_other_status = 1;

                $cart->period = $r->period;
                $cart->customer_name = $customer->name;
                $cart->shipping_type_id = $r->shipping_type_id;
                $cart->shipping_price = $r->shipping_price_total;
                $cart->total_price = $r->product_total_price;
                $cart->grand_total = $r->all_price_total;
                $cart->cart_products_id_arr = $r->cart_products_id;
                $cart->pay_other_cart_id_arr = $r->pay_other_cart_id_arr;
                //  ใส่ขนส่ง
                $shipping_name = DB::table('shipping_name')->where('id',1)->first();
                $cart->shipping_name_id = $shipping_name->id;
                $cart->shipping_name_name = $shipping_name->name;
                //
                $cart->save();

                 // บันทึกที่อยู่ shipping_date
                $customer_cart_address = CustomerCartAddress::where('customer_cart_id',$cart->id)->first();
                if(!$customer_cart_address){
                    $customer_cart_address = new CustomerCartAddress();
                }
                $customer_cart_address->customer_id = $cart->customer_id;

                $customer_cart_address->customer_cart_id = $cart->id;
                $customer_cart_address->customer_address_id = $cart->customer_address_id;

                $address = Customer_address::where('id',$cart->customer_address_id)->first();

                $customer_cart_address->name = $address->name;
                $customer_cart_address->tel = $address->tel;
                $customer_cart_address->address_number = $address->address_number;
                $customer_cart_address->province_id = $address->province_id;
                $customer_cart_address->amphures_id = $address->amphures_id;
                $customer_cart_address->district_id = $address->district_id;
                $customer_cart_address->zipcode = $address->zipcode;
                $customer_cart_address->address_lat = $address->address_lat;
                $customer_cart_address->address_long = $address->address_long;
                $customer_cart_address->save();


                if($cart->status==2){

                    // $pay_other_cart_id_arr = explode(',',$r->pay_other_cart_id_arr);
                    // foreach($pay_other_cart_id_arr as $c_arr){
                    //     $cart_other = CustomerCart::where('id',$c_arr)->where('customer_id',$r->user_id)->where('pay_other_status',1)->first();
                    //     $cart_other->pay_other_cart_id = $cart->id;
                    //     $cart_other->pay_status = 1;
                    //     $cart_other->save();
                    // }

                //     try
                //     {
                //     // เชื่อม API Makesend
                //     $url = url('api/api_search_person_date');
                //     $fields = array(
                //         'activity_type_id' => $r->activity_type_id,
                //         'min_price' => '',
                //         'max_price' => '',
                //         'sex_type' => '',
                //         'member_name' => $r->member_name,
                //         'date' => $r->date,
                //         'time_start' => $r->time_start,
                //         'time_end' => $r->time_end,
                //         'lat' => $r->lat,
                //         'long' => $r->long,
                //         'member_id' => $r->member_id,
                //     );

                //     $curl = curl_init($url);
                //     $fields_string = http_build_query($fields);

                //     curl_setopt($curl, CURLOPT_URL, $url);
                //     curl_setopt($curl, CURLOPT_POST, TRUE);
                //     curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
                //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                //     // curl_setopt($curl, CURLOPT_HEADER, false);
                //     // curl_setopt($ch, CURLOPT_HTTPHEADER, [
                //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
                //         'Authorization: 16fk7b3a-db88-4d79-bzck-29e52attq541',
                //     ]);

                //     $response1 = curl_exec($curl);
                //     curl_close($curl);
                //     $response1 =  json_decode($response1);
                // }
                //     catch (\Exception $e) {
                //         DB::rollback();
                //         return response()->json([
                //             'message' =>  'เชื่อมต่อ API ไม่สำเร็จ',
                //             'status' => 0,
                //             'data' => '',
                //         ]);
                //     }

                //     // dd($response1);

                //     if($response1->message != 'success'){
                //         DB::rollback();
                //         // return $e->getMessage();
                //         return response()->json([
                //             'message' =>  'เชื่อมต่อ API ไม่สำเร็จ2',
                //             'status' => 0,
                //             'data' => '',
                //         ]);
                //     }

                    $cart_products_id = explode(',',$r->cart_products_id);
                    $arr_pro = CustomerCartProduct::select('customer_cart_product.*')
                    ->where('customer_cart_product.customer_cart_id',$r->cart_id)->whereIn('id',$cart_products_id)->where('customer_cart_product.customer_id',$r->user_id)->get();

                    foreach($arr_pro as $p){
                        $customer_cart_store = DB::table('customer_cart_store')->select('id')->where('customer_cart_id',$r->cart_id)->where('store_id',$p->store_id)->first();
                        if(!$customer_cart_store){
                            DB::table('customer_cart_store')->insert([
                                'customer_cart_id' => $r->cart_id,
                                'store_id' => $p->store_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }

                        $product = DB::table('products')->where('id',$p->product_id)->first();
                        if($product){
                            DB::table('products')->where('id',$product->id)->update([
                                'sale_number' => $product->sale_number + $p->qty,
                            ]);
                        }

                        if($p->pre_order_status == 0){
                            $stock_lot = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                            ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
                            $qty_booking_sum = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                            ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->sum('qty_booking');
                            if(!$stock_lot){
                                DB::rollback();
                                return response()->json([
                                    'message' =>  'จำนวนสินค้าหมดแล้ว',
                                    'status' => 0,
                                    'data' => '',
                                ]);
                            }
                            if($p->qty > $qty_booking_sum){
                                return response()->json([
                                    'message' =>  'สินค้าบางรายการเกินจำนวนแล้ว',
                                    'status' => 0,
                                    'data' => '',
                                ]);
                            }
                        }else{
                            $stock_lot = StockLotPre::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))->orderBy('lot_expired_date','asc')->where('cut_off',0)->first();
                        }

                        // $stock_lot->qty_booking = $stock_lot->qty_booking-$p->qty;
                        // $stock_lot->save();
                        // $stock_items = StockItems::where('product_id',$p->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                        // $stock_items->qty_booking = $stock_items->qty_booking-$p->qty;
                        // $stock_items->save();

                        // จองสต็อก
                        $qty_mis_total = $p->qty;
                        if($qty_mis_total>0){
                            // ถ้าไม่ preorder
                            if($p->pre_order_status == 0){
                                $stock_lot_arr = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                                ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();
                                foreach($stock_lot_arr as $st_arr){
                                    if($qty_mis_total > 0){
                                        $stock_items = StockItems::where('product_id',$p->product_id)->where('stock_lot_id',$st_arr->id)->first();

                                        $customer_cart_product_cut_stock = new CustomerCartProductCutStock();
                                        $customer_cart_product_cut_stock->customer_cart_product_id = $p->id;
                                        $customer_cart_product_cut_stock->customer_cart_id = $p->customer_cart_id;
                                        $customer_cart_product_cut_stock->customer_id = $p->customer_id;
                                        $customer_cart_product_cut_stock->product_id = $p->product_id;
                                        $customer_cart_product_cut_stock->stock_lot_id = $stock_items->stock_lot_id;
                                        $customer_cart_product_cut_stock->stock_item_id = $stock_items->id;
                                        $customer_cart_product_cut_stock->qty_need = $qty_mis_total;
                                        if($stock_items->qty<$qty_mis_total){
                                            $customer_cart_product_cut_stock->qty_has = $stock_items->qty;
                                        }else{
                                            $customer_cart_product_cut_stock->qty_has = $qty_mis_total;
                                        }
                                        $qty_mis_total = ($qty_mis_total-$stock_items->qty);
                                        if($qty_mis_total < 0){
                                            $qty_mis_total = 0;
                                        }
                                        $customer_cart_product_cut_stock->qty_mis = $qty_mis_total;
                                        $customer_cart_product_cut_stock->save();

                                        // ตัดสต็อก booking
                                        $stock_lot_arr = StockLot::where('id',$st_arr->id)->first();
                                        $stock_lot->qty_booking = $stock_lot->qty_booking-$p->qty;
                                        $stock_lot->save();

                                        $stock_items = StockItems::where('product_id',$p->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                                        $stock_items->qty_booking = $stock_items->qty_booking-$customer_cart_product_cut_stock->qty_has;
                                        $stock_items->save();
                                    }
                                }
                        }else{
                            $stock_lot_arr = StockLotPre::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                            ->orderBy('lot_expired_date','asc')->where('cut_off',0)->get();
                            foreach($stock_lot_arr as $st_arr){
                                if($qty_mis_total > 0){

                                    $stock_items = StockItemsPre::where('product_id',$p->product_id)->where('stock_lot_id',$st_arr->id)->first();

                                    $customer_cart_product_cut_stock = new CustomerCartProductCutStock();
                                    $customer_cart_product_cut_stock->pre_order_status = 1;
                                    $customer_cart_product_cut_stock->customer_cart_product_id = $p->id;
                                    $customer_cart_product_cut_stock->customer_cart_id = $p->customer_cart_id;
                                    $customer_cart_product_cut_stock->customer_id = $p->customer_id;
                                    $customer_cart_product_cut_stock->product_id = $p->product_id;
                                    $customer_cart_product_cut_stock->stock_lot_id = $stock_items->stock_lot_id;
                                    $customer_cart_product_cut_stock->stock_item_id = $stock_items->id;
                                    $customer_cart_product_cut_stock->qty_need = $qty_mis_total;
                                    // if($stock_items->qty<$qty_mis_total){
                                    //     $customer_cart_product_cut_stock->qty_has = $stock_items->qty;
                                    // }else{
                                    $customer_cart_product_cut_stock->qty_has = $qty_mis_total;
                                    // }
                                    // $qty_mis_total = ($qty_mis_total-$stock_items->qty);
                                    // if($qty_mis_total < 0){
                                        $qty_mis_total = 0;
                                    // }
                                    $customer_cart_product_cut_stock->qty_mis = $qty_mis_total;
                                    $customer_cart_product_cut_stock->save();

                                    // ตัดสต็อก booking
                                    $stock_lot_arr = StockLotPre::where('id',$st_arr->id)->first();
                                    $stock_lot->qty_booking = $stock_lot->qty_booking+$p->qty;
                                    $stock_lot->save();

                                    $stock_items = StockItemsPre::where('product_id',$p->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                                    $stock_items->qty_booking = $stock_items->qty_booking+$customer_cart_product_cut_stock->qty_has;
                                    $stock_items->save();

                                    $products_item = ProductsItem::where('id',$stock_lot_arr->products_item_id)->first();
                                    $products_item->qty = $stock_items->qty_booking;
                                    $products_item->save();
                                }
                            }
                        }
                        }
                    }

                    // สร้าง tracking
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

                    $cart_new = new CustomerCart();
                    $cart_new->customer_id = $r->user_id;
                    $cart_new->shipping_type_id = 1;
                    $customer_address = Customer_address::
                              select('customer_address.id')
                    ->where('customer_address.customer_id',$r->user_id)
                    ->where('customer_address.default_active','Y')
                    ->first();
                    if($customer_address){
                        $cart_new->customer_address_id = $customer_address->id;
                    }
                    $cart_new->total_price = 0;
                    $cart_new->shipping_price = 0;
                    $cart_new->grand_total = 0;
                    $cart_new->has_promotion = 0;
                    $cart_new->discount_price = 0;
                    $cart_new->action_date = date('Y-m-d');
                    $cart_new->save();
                    // อัพเดทพวกที่เลหือไปตะกร้าใหม่
                    CustomerCartProduct::select('customer_cart_product.*')
                    ->where('customer_cart_product.customer_cart_id',$r->cart_id)->whereNotIn('id',$cart_products_id)->where('customer_cart_product.customer_id',$r->user_id)
                    ->update([
                        'customer_cart_id' => $cart_new->id,
                    ]);

                }

            }else{
                return response()->json([
                    'message' =>  'ไม่พบข้อมูลสินค้า',
                    'status' => 0,
                    'data' => '',
                ]);
            }

            DB::commit();

            return response()->json([
                'message' =>  'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $cart,
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

    public function api_get_order_list(Request $r)
    {
        $carts = CustomerCart::select('id')->where('customer_id',$r->user_id)->where('status',2)->where('transfer_status',0)->orderBy('id','desc')->get();
        $carts_shipping = CustomerCart::select('id')->where('customer_id',$r->user_id)->where('status',2)->where('transfer_status',1)->orderBy('id','desc')->get();
        $carts_success = CustomerCart::select('id')->where('customer_id',$r->user_id)->where('status',2)->where('transfer_status',2)->orderBy('id','desc')->get();

        $carts_claim = CustomerCart::select('id')->where('customer_id',$r->user_id)->where('status',2)->where('claim_status',1)->orderBy('id','desc')->get();

        $arr_cart = [];
        $arr_cart_shipping = [];
        $arr_cart_success = [];
        $cart_claim = [];

        foreach($carts as $key=> $c){
            if(!isset($r->limit)){
                $products = CustomerCartProduct::select('customer_cart_product.*',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
                ->join('products','products.id','customer_cart_product.product_id')
                ->join('brands','brands.id','products.brands_id')
                ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                // ->where('customer_cart.transfer_status',0)
                ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->limit(1)->get();
                $arr_cart[$key] = [];
                foreach($products as $key2 => $p){
                    // $arr_cart[$key] = $p;
                    array_push($arr_cart[$key],$p);
                }
            }else{

            $products = CustomerCartProduct::select('customer_cart_product.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            // ->where('customer_cart.transfer_status',0)
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            $arr_cart[$key] = [];
            foreach($products as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart[$key],$p);
            }
            }

        }

        foreach($carts_shipping as $key=> $c){
             if(!isset($r->limit)){
            $products2 = CustomerCartProduct::select('customer_cart_product.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart.transfer_status',1)
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->limit(1)->get();
            $arr_cart_shipping[$key] = [];
            foreach($products2 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_shipping[$key],$p);
            }
        }else{
            $products2 = CustomerCartProduct::select('customer_cart_product.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart.transfer_status',1)
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            $arr_cart_shipping[$key] = [];
            foreach($products2 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_shipping[$key],$p);
            }
        }

        }

        foreach($carts_success as $key=> $c){
            if(!isset($r->limit)){
            $products3 = CustomerCartProduct::select('customer_cart_product.*','customer_cart.grand_total as cart_grand_total',
            'customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)
            ->where('customer_cart.transfer_status',2)
            ->limit(1)
            ->get();
            $arr_cart_success[$key] = [];
            foreach($products3 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_success[$key],$p);
            }
        }else{
            $products3 = CustomerCartProduct::select('customer_cart_product.*','customer_cart.grand_total as cart_grand_total',
            'customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)
            ->where('customer_cart.transfer_status',2)
            ->get();
            $arr_cart_success[$key] = [];
            foreach($products3 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_success[$key],$p);
            }
        }
        }

        foreach($carts_claim as $key=> $c){
            if(!isset($r->limit)){
                $products = CustomerCartProduct::select('customer_cart_product.*',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
                ->join('products','products.id','customer_cart_product.product_id')
                ->join('brands','brands.id','products.brands_id')
                ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                // ->where('customer_cart.transfer_status',0)
                ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->limit(1)->get();
                $cart_claim[$key] = [];
                foreach($products as $key2 => $p){
                    // $arr_cart[$key] = $p;
                    array_push($cart_claim[$key],$p);
                }
            }else{

            $products = CustomerCartProduct::select('customer_cart_product.*',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            // ->where('customer_cart.transfer_status',0)
            ->where('customer_cart_product.customer_cart_id',$c->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            $cart_claim[$key] = [];
            foreach($products as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($cart_claim[$key],$p);
            }
            }

        }

        $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart' => $arr_cart,
                    'cart_shipping' => $arr_cart_shipping,
                    'cart_success' => $arr_cart_success,
                    'cart_claim' => $cart_claim,
                    'url_img' => $url_img,
                ],
            ]);
    }

    public function api_get_order_list_store(Request $r)
    {
        $store = Store::where('customer_id',$r->user_id)->first();
        $store_success = DB::table('customer_cart_store')->select('customer_cart_id')->where('store_id',$store->id)->pluck('customer_cart_id')->toArray();

        $carts_success = CustomerCart::select('id')->whereIn('id',$store_success)->where('status',2)->where('transfer_status',2)->orderBy('id','desc')->get();
        // $carts_claim = CustomerCart::select('id')->whereIn('id',$store_success)->where('status',2)->where('claim_status',1)->where('status_assign_claim','Y')->orderBy('id','desc')->get();
        $carts_claim = CustomerCart::select('customer_cart.id')
        ->join('customer_cart_claim','customer_cart_claim.customer_cart_id','customer_cart.id')
        ->whereIn('customer_cart.id',$store_success)
        ->where('customer_cart_claim.store_id',$store->id)
        ->where('customer_cart.status',2)
        ->where('customer_cart.claim_status',1)
        ->where('customer_cart.status_assign_claim','Y')
        ->orderBy('customer_cart.id','desc')->get();

        $arr_cart_success = [];
        $cart_claim = [];

        $store_total_price_success = [];
        foreach($carts_success as $key=> $c){

            if(!isset($r->limit)){
            $products3 = CustomerCartProduct::select('customer_cart_product.*','customer_cart.grand_total as cart_grand_total',
            'customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart_product.customer_cart_id',$c->id)
            ->where('customer_cart_product.store_id',$store->id)
            ->where('customer_cart.transfer_status',2)
            ->limit(1)
            ->get();
            $arr_cart_success[$key] = [];
            foreach($products3 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_success[$key],$p);
            }
        }else{

            $products3 = CustomerCartProduct::select('customer_cart_product.*','customer_cart.grand_total as cart_grand_total',
            'customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price',
            'brands.name_th as brand_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            )
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('customer_cart_product.customer_cart_id',$c->id)
            ->where('customer_cart_product.store_id',$store->id)
            ->where('customer_cart.transfer_status',2)
            ->get();
            $arr_cart_success[$key] = [];
            foreach($products3 as $key2 => $p){
                // $arr_cart[$key] = $p;
                array_push($arr_cart_success[$key],$p);
            }
        }
        }

        $store_total_price_claim = [];

        foreach($carts_claim as $key=> $c){
            $price = 0;

            if(!isset($r->limit)){

                $products = CustomerCartProduct::select('customer_cart_product.*',
                'customer_cart_claim.status as cart_claim_status','customer_cart_claim.status_assign as cart_claim_status_assign',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
                ->join('products','products.id','customer_cart_product.product_id')
                ->join('brands','brands.id','products.brands_id')
                ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
                ->join('products_gallery','products_gallery.product_id','products.id')
                ->join('customer_cart_claim','customer_cart_claim.customer_cart_id','customer_cart_product.customer_cart_id')
                // ->where('customer_cart.transfer_status',0)
                ->where('customer_cart_product.customer_cart_id',$c->id)
                ->where('customer_cart_product.store_id',$store->id)
                ->where('customer_cart_product.claim_status',1)
                ->where('customer_cart_claim.store_id',$store->id)
                // ->limit(1)
                ->get();
                $cart_claim[$key] = [];
                foreach($products as $key2 => $p){
                    $price += $p->total_price;
                    // $arr_cart[$key] = $p;
                    if($key2==0){
                        array_push($cart_claim[$key],$p);
                    }
                }
            }else{

            $products = CustomerCartProduct::select('customer_cart_product.*',
            'customer_cart_claim.status as cart_claim_status','customer_cart_claim.status_assign as cart_claim_status_assign',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name','customer_cart.grand_total as cart_grand_total','customer_cart.order_number','products.name_th as product_name','customer_cart_product.price as product_price','brands.name_th as brand_name')
            ->join('products','products.id','customer_cart_product.product_id')
            ->join('brands','brands.id','products.brands_id')
            ->join('customer_cart','customer_cart.id','customer_cart_product.customer_cart_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('customer_cart_claim','customer_cart_claim.customer_cart_id','customer_cart_product.customer_cart_id')
            // ->where('customer_cart.transfer_status',0)
            ->where('customer_cart_product.customer_cart_id',$c->id)
            ->where('customer_cart_product.store_id',$store->id)
            ->where('customer_cart_product.claim_status',1)
            ->where('customer_cart_claim.store_id',$store->id)
            ->get();
            $cart_claim[$key] = [];
            foreach($products as $key2 => $p){
                $price += $p->total_price;
                // $arr_cart[$key] = $p;
                array_push($cart_claim[$key],$p);
            }
            }

            array_push($store_total_price_claim,$price);

        }

        $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'cart_success' => $arr_cart_success,
                    'cart_claim' => $cart_claim,
                    'url_img' => $url_img,
                    'store_total_price_claim' => $store_total_price_claim,
                ],
            ]);
    }


    public function api_get_product_list(Request $r)
    {
        $customer = Customer::where('id',$r->user_id)->first();
        if($customer){
            $store = Store::where('customer_id',$r->user_id)->first();

            $product_preorder = Products::select('products.*',
            // 'products_item.transfer_status',
            // 'products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'store.logo_path','store.logo',
            )
            // ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products.store_id',$store->id)
            ->where('products_gallery.use_profile',1)
            // ->where('products_item.approve_status',1)
            // ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            // ->whereNotIn('products.id',$p_arr_not)
            ->where('products.preorder_active',1)
            ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

            // if($store->id==1){
            //     $product_preorder = Products::select('products.*',
            //     // 'products_item.transfer_status',
            //     // 'products_item.id as products_item_id',
            //     'products_gallery.path as gal_path',
            //     'products_gallery.name as gal_name',
            //     'store.logo_path','store.logo',
            //     )
            //     // ->join('products_item','products_item.product_id','products.id')
            //     ->join('products_gallery','products_gallery.product_id','products.id')
            //     ->join('store','store.id','products.store_id')
            //     // ->where('products.store_id',$store->id)
            //     ->where('products_gallery.use_profile',1)
            //     // ->where('products_item.approve_status',1)
            //     // ->where('products_item.transfer_status',3)
            //     ->where('products.display_status',1)
            //     // ->whereNotIn('products.id',$p_arr_not)
            //     ->where('products.preorder_active',1)
            //     ->orderBy('products.sale_number','desc')
            //     ->inRandomOrder()->get();
            // }

            $product_all = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
              'store.logo_path','store.logo',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
              ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->orderBy('products.created_at','desc')
            ->get();

            $product_wait = ProductsItem::select('products.*','products_item.transfer_status','products_item.id as products_item_id','products_item.qty as products_item_qty',
            'products_gallery.path as gal_path',
              'store.logo_path','store.logo',
            'products_gallery.name as gal_name',
            'products_item.shipping_date',
            )
            ->join('products','products.id','products_item.product_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            ->where('products_item.transfer_status','!=',3)
            ->where('products.display_status',1)
            ->where('products.normal_active',1)
            ->where('products_item.is_preorder',0)
            ->orderBy('products.created_at','desc')
            ->get();

            $product_wait_pre = ProductsItem::select('products.*','products_item.transfer_status','products_item.transfer_status','products_item.id as products_item_id','products_item.qty as products_item_qty',
            'products_gallery.path as gal_path',
              'store.logo_path','store.logo',
            'products_gallery.name as gal_name',
            'products_item.is_preorder',
            'products_item.transfer_status',
            'products_item.shipping_date',
            'products_item.preorder_date_cut_off',
            'products_item.preorder_date_bringme',

            'products_item.is_preorder as products_item_is_preorder',
            'products_item.shipping_date as products_item_shipping_date',
            'products_item.transfer_status as products_item_transfer_status',
            )
            ->join('products','products.id','products_item.product_id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            // ->where('products.preorder_active',1)
            // ->where('products_item.transfer_status','!=',3)
            ->where('products_item.is_preorder',1)
            ->where('products.display_status',1)
             ->orderBy('products_item.transfer_status','asc')
            ->orderBy('products.created_at','desc')
            ->orderBy('products_item.transfer_status','asc')
            ->get();

            $product_not_show = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
              'store.logo_path','store.logo',
            'products_gallery.name as gal_name',
            'products_item.is_preorder',
            // 'products_item.created_at',
            'products_item.transfer_status',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
              ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            // ->where('products_item.transfer_status',3)
            ->where('products.display_status',2)
            ->orderBy('products_item.id','desc')
            ->get();

            $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer' => $customer,
                    'store' => $store,
                    'product_all' => $product_all,
                    'product_wait' => $product_wait,
                    'product_not_show' => $product_not_show,
                    'product_wait_pre' => $product_wait_pre,
                    'url_img' => $url_img,
                    'product_preorder' => $product_preorder,
                ],
            ]);
        }else{
            return response()->json([
                'message' => 'ไม่พบข้อมูผู้ใช้',
            ]);
        }
    }

    public function api_get_store(Request $r)
    {
        $customer = Customer::where('id',$r->user_id)->first();
        if($customer){
            $store = Store::where('customer_id',$r->user_id)->first();
            $product_number = DB::table('products')->select('id')->where('store_id',$store->id)->where('approve_status',1)->get();
            $product_number = count($product_number);
            $store_rate = number_format($store->rate,'1');
            $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer' => $customer,
                    'store' => $store,
                    'product_number' => $product_number,
                    'store_rate' => $store_rate,
                    'url_img' => $url_img,
                ],
            ]);
        }else{
            return response()->json([
                'message' => 'ไม่พบข้อมูผู้ใช้',
                'status' => 0,
                'data' => '',
            ]);
        }

    }

    public function api_get_store_detail(Request $r)
    {
        $store = Store::where('id',$r->store_id)->first();
        if($store){
            $products = DB::table('products')->select('id')->where('store_id',$store->id)->where('approve_status',1)->get();
            $product_number = count($products);
            $store_rate = number_format($store->rate,'1');
            $url_img = Storage::disk('public')->url('');

            $product_new = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'store.logo_path','store.logo',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->where('products.store_id',$store->id)
            // ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

            $product_good_sale = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
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
            ->where('products.store_id',$store->id)
            // ->orderBy('products.sale_number','desc')
            ->inRandomOrder()->get();

             $product_recome = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'store.logo_path','store.logo',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->where('products.store_id',$store->id)
            // ->orderBy('products.updated_at','desc')
            ->inRandomOrder()->get();

            $following = 0;
            if(isset($r->customer_id)){
                $following = DB::table('store_following')->where('customer_id',$r->customer_id)->where('store_id',$store->id)->where('status',1)->first();
                if($following){
                    $following = 1;
                }else{
                    $following = 0;
                }
            }

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'store' => $store,
                    'product_number' => $product_number,
                    'store_rate' => $store_rate,
                    'url_img' => $url_img,

                    'product_new' => $product_new,
                    'product_good_sale' => $product_good_sale,
                    'product_recome' => $product_recome,

                    'following' => $following,
                ],
            ]);
        }else{
            return response()->json([
                'message' => 'ไม่พบข้อมูผู้ใช้',
                'status' => 0,
                'data' => '',
            ]);
        }
    }

    public function api_product_store(Request $r)
    {
        DB::beginTransaction();
        try
            {
                $store = Store::where('customer_id',$r->user_id)->first();
                // $r->production_date = date('Y-m-d', strtotime($r->production_date));
                // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date)); shipping_date_pre

                // เพิ่มสินค้าหลัก
                if($r->function_type == 'edit_product'){
                    $products = Products::where('id',@$r->product_id)->first();
                }
                if($r->function_type == 'add_product'){
                    $products = new Products();
                    $products->qty = 0;
                    $products->min_price = 0;
                    $products->max_price = 0;
                }
                $products->name_th = $r->name_th;
                $products->name_en = $r->name_en;
                $products->detail_th = $r->detail_th;
                $products->detail_en = $r->detail_en;

                $products->shelf_lift = $r->shelf_lift;
                $products->stock_cut_off = $r->stock_cut_off;

                $products->category_id = $r->category_id;
                $products->brands_id = $r->brands_id;
                $products->storage_method_id = $r->storage_method_id;
                $products->store_id = $store->id;
                $products->customer_id = $r->user_id;
                $products->normal_active = $r->normal_active;
                $products->preorder_active = $r->preorder_active;
                $products->save();

                if($r->function_type == 'add_product'){
                    $products_code = str_pad($products->id, 6, '0', STR_PAD_LEFT);
                    $products->products_code = 'BM'.$products_code.'B';
                    $products->barcode = $products->id.date('YmdHis');
                    $products->save();
                }

                if($r->function_type == 'add_product'){
                if($products->normal_active==1){
                $products_item = new ProductsItem();
                $products_item->product_id = $products->id;
                $products_item->customer_id = $r->user_id;
                $products_item->name_th = $r->name_th;
                $products_item->name_en = $r->name_en;
                $products_item->detail_th = $r->detail_th;
                $products_item->detail_en = $r->detail_en;
                $products_item->shelf_lift = $r->shelf_lift;
                $products_item->store_id = $store->id;
                $products_item->price = $r->price;
                $products_item->qty = $r->qty;
                $products_item->stock_cut_off = $r->stock_cut_off;
                $products_item->production_date = $r->production_date;
                $products_item->shipping_date = $r->shipping_date;
                $products_item->products_code = $products->products_code;
                $products_item->save();
                }
                if($r->preorder_active == 1){
                    // เพิ่ม item สินค้า
                    $products_item_pre = new ProductsItem();
                    $products_item_pre->product_id = $products->id;
                    $products_item_pre->customer_id = $r->user_id;
                    $products_item_pre->name_th = $r->name_th;
                    $products_item_pre->name_en = $r->name_en;
                    $products_item_pre->detail_th = $r->detail_th;
                    $products_item_pre->detail_en = $r->detail_en;
                    $products_item_pre->shelf_lift = $r->shelf_lift;
                    $products_item_pre->store_id = $store->id;
                    $products_item_pre->price = $r->price;
                    $products_item_pre->qty = 0;
                    $products_item_pre->stock_cut_off = $r->stock_cut_off;
                    $products_item_pre->production_date = $r->production_date;
                    $products_item_pre->shipping_date = $r->shipping_date_pre;
                    $products_item_pre->preorder_date_cut_off = $r->preorder_date_cut_off;
                    $products_item_pre->preorder_date_bringme = $r->preorder_date_bringme;
                    $products_item_pre->products_code = $products->products_code;
                    $products_item_pre->is_preorder = 1;
                    $products_item_pre->save();
                }
                $price_arr = [];
                $qty_all = 0;
                if($r->yes_option == '1'){
                   $products_option_1_arr = json_decode($r->products_option_1);
                   $products_option_head1 = new ProductsOptionHead();
                   $products_option_head1->product_id = $products->id;
                   $products_option_head1->option_type = 1;
                   $products_option_head1->name_th = $r->products_option_head1;
                   $products_option_head1->name_en = $r->products_option_head1;
                   $products_option_head1->save();

                   $products_option_head2 = new ProductsOptionHead();
                   $products_option_head2->product_id = $products->id;
                   $products_option_head2->option_type = 2;
                   $products_option_head2->name_th = $r->products_option_head2;
                   $products_option_head2->name_en = $r->products_option_head2;
                   $products_option_head2->save();

                    // บันทึก ตัวเลือก 2
                    $products_option_2_arr = json_decode($r->products_option_2);
                    $arr_option2_id = [];
                    foreach($products_option_2_arr as $pr2){
                        $products_option_2 = new ProductsOption2();
                        $products_option_2->product_id = $products->id;
                        $products_option_2->name_th = $pr2->name_th;
                        $products_option_2->name_en = $pr2->name_th;
                        $products_option_2->save();
                        array_push($arr_option2_id, $products_option_2->id);
                    }

                    // บันทึกตัวเลือก 1
                    foreach($products_option_1_arr as $pr){
                        $products_option_1 = new ProductsOption1();
                        $products_option_1->product_id = $products->id;
                        $products_option_1->name_th = $pr->name_th;
                        $products_option_1->name_en = $pr->name_th;
                        $products_option_1->save();

                        // วน list
                        foreach($pr->product_option2_list as $pr_list){
                        $products_option_2_id = ProductsOption2::select('id')->whereIn('id',$arr_option2_id)->where('name_th',$pr_list->name_th)->first();

                        // สร้างจำนวนสินค้า
                        $products_option_2_items = new ProductsOption2Items();
                        $products_option_2_items->product_id = $products->id;

                        if($products->normal_active==1){
                            $products_option_2_items->products_item_id = $products_item->id;
                        }

                        if($products->preorder_active==1){
                            $products_option_2_items->products_item_pre_id = $products_item_pre->id;
                        }

                        $products_option_2_items->option_1_id = $products_option_1->id;
                        $products_option_2_items->option_2_id = $products_option_2_id->id;
                        $products_option_2_items->price = $pr_list->price;
                        $products_option_2_items->qty = $pr_list->qty;
                        $products_option_2_items->name_th = $pr->name_th.' '.$pr_list->name_th;
                        $products_option_2_items->name_en = $pr->name_th.' '.$pr_list->name_th;
                        $products_option_2_items->save();

                        array_push($price_arr, $pr_list->price);
                        $qty_all += $pr_list->qty;

                        $new_barcode = $this->generateRandomString(10);
                        $products_option_2_items->barcode = $new_barcode;
                        $products_option_2_items->save();
                        }
                    }

                    if($products->normal_active==1){
                        $products_item->qty = $qty_all;
                        $products_item->save();
                        }
                }else{
                    $products_option_head1 = new ProductsOptionHead();
                    $products_option_head1->product_id = $products->id;
                    $products_option_head1->option_type = 1;
                    $products_option_head1->name_th = '';
                    $products_option_head1->name_en = '';
                    $products_option_head1->save();

                    $products_option_head2 = new ProductsOptionHead();
                    $products_option_head2->product_id = $products->id;
                    $products_option_head2->option_type = 2;
                    $products_option_head2->name_th = '';
                    $products_option_head2->name_en = '';
                    $products_option_head2->save();

                    $products_option_1 = new ProductsOption1();
                    $products_option_1->product_id = $products->id;
                    $products_option_1->name_th = '';
                    $products_option_1->name_en = '';
                    $products_option_1->save();

                    $products_option_2 = new ProductsOption2();
                    $products_option_2->product_id = $products->id;
                    $products_option_2->name_th = '';
                    $products_option_2->name_en = '';
                    $products_option_2->save();

                    $products_option_2_items = new ProductsOption2Items();
                    $products_option_2_items->product_id = $products->id;

                    if($products->normal_active==1){
                        $products_option_2_items->products_item_id = $products_item->id;
                    }

                    if($products->preorder_active==1){
                        $products_option_2_items->products_item_pre_id = $products_item_pre->id;
                    }

                    $products_option_2_items->option_1_id = $products_option_1->id;
                    $products_option_2_items->option_2_id = $products_option_2->id;
                    $products_option_2_items->price = $r->price;
                    $products_option_2_items->qty = $r->qty;
                    $products_option_2_items->name_th = '';
                    $products_option_2_items->name_en = '';
                    $products_option_2_items->save();

                    array_push($price_arr, $r->price);

                    $new_barcode = $this->generateRandomString(10);
                    $products_option_2_items->barcode = $new_barcode;
                    $products_option_2_items->save();
                }

                if(count($price_arr) > 1){
                    $products->min_price = min($price_arr);
                    $products->max_price = max($price_arr);
                }elseif(count($price_arr)== 1){
                    $products->min_price = $price_arr[0];
                    $products->max_price = $price_arr[0];
                }
                else{
                    $products->min_price = $r->price;
                    $products->max_price = $r->price;
                }
            }

                $products->save();

                    $gal = explode('|',$r->images);
                    $gal_use = ProductsGallery::where('product_id',$products->id)->where('use_profile',1)->first();
                    foreach ($gal as $key => $img) {
                        if($img!=''){
                            $image_64 = $img;
                            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                             // find substring fro replace here eg: data:image/png;base64,
                            $image = str_replace($replace, '', $image_64);
                            $image = str_replace(' ', '+', $image);
                            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                            Storage::disk('public')->put('product/'.$products->customer_id.'/'.$products->id.'/' . $imageName, base64_decode($image));
                            // Storage::delete('file_payment/' . $check->file_slip);

                            $gal = new ProductsGallery();
                            $gal->path = 'product/'.$products->customer_id.'/'.$products->id.'/';
                            $gal->name = $imageName;
                            $gal->product_id = $products->id;
                            if($key==0){
                                if(!$gal_use){
                                    $gal->use_profile = 1;
                                }else{
                                    $gal->use_profile = 0;
                                }
                            }else{
                                $gal->use_profile = 0;
                            }
                            $gal->save();
                        }
                }

                if($r->function_type == 'add_product'){
                if($r->preorder_active == 1){

                    $stock_pre = new StockPre();
                    $stock_pre->product_id = $products->id;
                    $stock_pre->store_id = $store->id;
                    $stock_pre->customer_id = $products->customer_id;
                    $stock_pre->save();

                    $stock_lot_pre = new StockLotPre();
                    $stock_lot_pre->stock_id = $stock_pre->id;
                    $stock_lot_pre->product_id = $products->id;
                    $stock_lot_pre->customer_id = $products->customer_id;
                    $stock_lot_pre->store_id = $store->id;
                    $stock_lot_pre->date_in_stock = date('Y-m-d');
                    // $stock_lot_pre->lot_expired_date = $products->preorder_shipping_date;
                    $stock_lot_pre->lot_expired_date = $products_item_pre->shipping_date;
                    $stock_lot_pre->lot_number = date('YmdHis');
                    $stock_lot_pre->qty = 0;
                    $stock_lot_pre->qty_booking = 0;
                    $stock_lot_pre->products_item_id = $products_item_pre->id;
                    $stock_lot_pre->save();

                    $products_option_2_items = ProductsOption2Items::where('product_id',$products->id)->where('products_item_pre_id',$products_item_pre->id)->get();
                    foreach($products_option_2_items as $pro){
                        $stock_items_pre = new StockItemsPre();
                        $stock_items_pre->stock_lot_id = $stock_lot_pre->id;
                        $stock_items_pre->stock_id = $stock_pre->id;
                        $stock_items_pre->product_id = $products->id;
                        $stock_items_pre->customer_id = $products->customer_id;
                        $stock_items_pre->products_option_2_items_id = $pro->id;
                        $stock_items_pre->products_item_id = $products_item_pre->id;
                        if($products_option_1->name_th!=''){
                            $stock_items_pre->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
                        }else{
                            $stock_items_pre->name = $products->name_th;
                        }

                        $stock_items_pre->qty = 0;
                        $stock_items_pre->qty_booking = 0;
                        $stock_items_pre->price = $pro->price;
                        $stock_items_pre->save();
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

    public function api_products_gal_remove(Request $r)
    {
        $gal_use = ProductsGallery::where('id')->where('product_id',$products->id)->where('use_profile',1)->first();
    }

    public function api_product_store_more_pre(Request $r)
    {
        DB::beginTransaction();
        try
            {
                $store = Store::where('customer_id',$r->user_id)->first();
                // $r->production_date = date('Y-m-d', strtotime($r->production_date));
                // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date)); stock_cut_off

                // เพิ่มรอบจัดส่ง
                $products = Products::where('id',$r->product_id)->first();
                // $products->name_th = $r->name_th;
                // $products->name_en = $r->name_en;
                // $products->detail_th = $r->detail_th;
                // $products->detail_en = $r->detail_en;
                // $products->category_id = $r->category_id;
                // $products->brands_id = $r->brands_id;
                // $products->shelf_lift = $r->shelf_lift;
                // $products->storage_method_id = $r->storage_method_id;
                // $products->store_id = $store->id;
                // $products->customer_id = $r->user_id;
                // $products->price = $r->price;
                // $products->qty = 0;
                // $products->stock_cut_off = $r->stock_cut_off;
                // $products->production_date = $r->production_date;
                // $products->shipping_date = $r->shipping_date;
                // $products->normal_active = $r->normal_active;
                // $products->preorder_active = $r->preorder_active;
                // $products->preorder_shipping_date = $r->shipping_date_pre;
                // $products->min_price = 0;
                // $products->max_price = 0;
                // $products->save();

                // $products_code = str_pad($products->id, 6, '0', STR_PAD_LEFT);
                // $products->products_code = 'BM'.$products_code.'B';
                // $products->barcode = $products->id.date('YmdHis');

                // $products->save();

                // if($products->normal_active==1){
                // // เพิ่ม item สินค้า storage_method_id brands_id
                // $products_item = new ProductsItem();
                // $products_item->product_id = $products->id;
                // $products_item->customer_id = $r->user_id;
                // $products_item->name_th = $r->name_th;
                // $products_item->name_en = $r->name_en;
                // $products_item->detail_th = $r->detail_th;
                // $products_item->detail_en = $r->detail_en;
                // // $products_item->category_id = $r->category_id;
                // // $products_item->brands_id = $r->brands_id;
                // $products_item->shelf_lift = $r->shelf_lift;
                // // $products_item->storage_method_id = $r->storage_method_id;
                // $products_item->store_id = $store->id;
                // $products_item->price = $r->price;
                // $products_item->qty = $r->qty;
                // $products_item->stock_cut_off = $r->stock_cut_off;
                // $products_item->production_date = $r->production_date;
                // $products_item->shipping_date = $r->shipping_date;
                // $products_item->products_code = $products->products_code;
                // // $products_item->barcode = $products->barcode;
                // $products_item->save();
                // }

                if($products->preorder_active == 1){
                    // เพิ่ม item สินค้า storage_method_id brands_id
                    $products_item_pre = new ProductsItem();
                    $products_item_pre->product_id = $products->id;
                    $products_item_pre->customer_id = $r->user_id;
                    $products_item_pre->name_th = $r->name_th;
                    $products_item_pre->name_en = $r->name_en;
                    $products_item_pre->detail_th = $r->detail_th;
                    $products_item_pre->detail_en = $r->detail_en;
                    $products_item_pre->shelf_lift = $r->shelf_lift;
                    $products_item_pre->store_id = $store->id;
                    $products_item_pre->price = $r->price;
                    $products_item_pre->qty = 0;
                    $products_item_pre->stock_cut_off = $r->stock_cut_off;
                    $products_item_pre->production_date = $r->production_date;
                    $products_item_pre->shipping_date = $r->shipping_date;
                    $products_item_pre->products_code = $products->products_code;
                    $products_item_pre->is_preorder = 1;
                    $products_item_pre->preorder_date_cut_off = $r->preorder_date_cut_off;
                    $products_item_pre->preorder_date_bringme = $r->preorder_date_bringme;
                    $products_item_pre->save();
                }


                $price_arr = [];
                $qty_all = 0;
                if($r->yes_option == '1'){
                   $products_option_1_arr = json_decode($r->products_option_1);
                   $products_option_head1 = new ProductsOptionHead();
                   $products_option_head1->product_id = $products->id;
                   $products_option_head1->option_type = 1;
                   $products_option_head1->name_th = $r->products_option_head1;
                   $products_option_head1->name_en = $r->products_option_head1;
                   $products_option_head1->save();

                   $products_option_head2 = new ProductsOptionHead();
                   $products_option_head2->product_id = $products->id;
                   $products_option_head2->option_type = 2;
                   $products_option_head2->name_th = $r->products_option_head2;
                   $products_option_head2->name_en = $r->products_option_head2;
                   $products_option_head2->save();

                    // บันทึก ตัวเลือก 2
                    $products_option_2_arr = json_decode($r->products_option_2);
                    $arr_option2_id = [];
                    foreach($products_option_2_arr as $pr2){
                        $products_option_2 = new ProductsOption2();
                        $products_option_2->product_id = $products->id;
                        $products_option_2->name_th = $pr2->name_th;
                        $products_option_2->name_en = $pr2->name_th;
                        $products_option_2->save();
                        array_push($arr_option2_id, $products_option_2->id);
                    }

                    // บันทึกตัวเลือก 1
                    foreach($products_option_1_arr as $pr){
                        $products_option_1 = new ProductsOption1();
                        $products_option_1->product_id = $products->id;
                        $products_option_1->name_th = $pr->name_th;
                        $products_option_1->name_en = $pr->name_th;
                        $products_option_1->save();

                        // วน list
                        foreach($pr->product_option2_list as $pr_list){
                        $products_option_2_id = ProductsOption2::select('id')->whereIn('id',$arr_option2_id)->where('name_th',$pr_list->name_th)->first();

                        // สร้างจำนวนสินค้า
                        $products_option_2_items = new ProductsOption2Items();
                        $products_option_2_items->product_id = $products->id;

                        // if($products->normal_active==1){
                        //     $products_option_2_items->products_item_id = $products_item->id;
                        // }

                        if($products->preorder_active==1){
                            $products_option_2_items->products_item_pre_id = $products_item_pre->id;
                        }

                        $products_option_2_items->option_1_id = $products_option_1->id;
                        $products_option_2_items->option_2_id = $products_option_2_id->id;
                        $products_option_2_items->price = $pr_list->price;
                        $products_option_2_items->qty = $pr_list->qty;
                        $products_option_2_items->name_th = $pr->name_th.' '.$pr_list->name_th;
                        $products_option_2_items->name_en = $pr->name_th.' '.$pr_list->name_th;
                        $products_option_2_items->save();

                        array_push($price_arr, $pr_list->price);
                        $qty_all += $pr_list->qty;

                        $new_barcode = $this->generateRandomString(10);
                        // $products_option_2_items->barcode = $products->barcode.$products_option_2_items->id;
                        $products_option_2_items->barcode = $new_barcode;
                        $products_option_2_items->save();
                        }
                    }

                    // if($products->normal_active==1){
                    // $products_item->qty = $qty_all;
                    // $products_item->save();
                    // }


                }else{
                    $products_option_head1 = new ProductsOptionHead();
                    $products_option_head1->product_id = $products->id;
                    $products_option_head1->option_type = 1;
                    $products_option_head1->name_th = '';
                    $products_option_head1->name_en = '';
                    $products_option_head1->save();

                    $products_option_head2 = new ProductsOptionHead();
                    $products_option_head2->product_id = $products->id;
                    $products_option_head2->option_type = 2;
                    $products_option_head2->name_th = '';
                    $products_option_head2->name_en = '';
                    $products_option_head2->save();

                    $products_option_1 = new ProductsOption1();
                    $products_option_1->product_id = $products->id;
                    $products_option_1->name_th = '';
                    $products_option_1->name_en = '';
                    $products_option_1->save();

                    $products_option_2 = new ProductsOption2();
                    $products_option_2->product_id = $products->id;
                    $products_option_2->name_th = '';
                    $products_option_2->name_en = '';
                    $products_option_2->save();

                    $products_option_2_items = new ProductsOption2Items();
                    $products_option_2_items->product_id = $products->id;

                    // if($products->normal_active==1){
                    //     $products_option_2_items->products_item_id = $products_item->id;
                    // }

                    if($products->preorder_active==1){
                        $products_option_2_items->products_item_pre_id = $products_item_pre->id;
                    }

                    $products_option_2_items->option_1_id = $products_option_1->id;
                    $products_option_2_items->option_2_id = $products_option_2->id;
                    $products_option_2_items->price = $r->price;
                    $products_option_2_items->qty = 0;
                    $products_option_2_items->name_th = '';
                    $products_option_2_items->name_en = '';
                    $products_option_2_items->save();

                    array_push($price_arr, $r->price);

                    $new_barcode = $this->generateRandomString(10);
                    // $products_option_2_items->barcode = $products->barcode.$products_option_2_items->id;
                    $products_option_2_items->barcode = $new_barcode;
                    $products_option_2_items->save();
                }

                if(count($price_arr) > 1){
                    $products->min_price = min($price_arr);
                    $products->max_price = max($price_arr);
                }elseif(count($price_arr)== 1){
                    $products->min_price = $price_arr[0];
                    $products->max_price = $price_arr[0];
                }
                else{
                    $products->min_price = $r->price;
                    $products->max_price = $r->price;
                }

                $products->save();

                //     $gal = explode('|',$r->images);
                //     foreach ($gal as $key => $img) {
                //         if($img!=''){
                //             $image_64 = $img;
                //             $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                //             $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                //              // find substring fro replace here eg: data:image/png;base64,
                //             $image = str_replace($replace, '', $image_64);
                //             $image = str_replace(' ', '+', $image);
                //             $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                //             Storage::disk('public')->put('product/'.$products->customer_id.'/'.$products->id.'/' . $imageName, base64_decode($image));
                //             // Storage::delete('file_payment/' . $check->file_slip);

                //             $gal = new ProductsGallery();
                //             $gal->path = 'product/'.$products->customer_id.'/'.$products->id.'/';
                //             $gal->name = $imageName;
                //             $gal->product_id = $products->id;
                //             if($key==0){
                //                 $gal->use_profile = 1;
                //             }else{
                //                 $gal->use_profile = 0;
                //             }
                //             $gal->save();
                //             // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                //         }
                // }

                if($products->preorder_active == 1){

                    $stock_pre = StockPre::where('product_id',$products->id)->where('store_id',$store->id)
                    ->where('customer_id',$products->customer_id)->first();
                    if(!$stock_pre){
                        $stock_pre = new StockPre();
                        $stock_pre->product_id = $products->id;
                        $stock_pre->store_id = $store->id;
                        $stock_pre->customer_id = $products->customer_id;
                        $stock_pre->save();
                    }

                    StockLotPre::where('product_id',$products->id)->where('cut_off',0)->update([
                        'cut_off'=>1,
                    ]);

                    $stock_lot_pre = new StockLotPre();
                    $stock_lot_pre->stock_id = $stock_pre->id;
                    $stock_lot_pre->product_id = $products->id;
                    $stock_lot_pre->customer_id = $products->customer_id;
                    $stock_lot_pre->store_id = $store->id;
                    $stock_lot_pre->date_in_stock = date('Y-m-d');
                    // $stock_lot_pre->lot_expired_date = '9999-'.date('m-d');
                    // $stock_lot_pre->lot_expired_date = $products->preorder_shipping_date;
                    $stock_lot_pre->lot_expired_date = $products_item_pre->preorder_date_bringme;
                    $stock_lot_pre->lot_number = date('YmdHis');
                    $stock_lot_pre->qty = 0;
                    $stock_lot_pre->qty_booking = 0;
                    $stock_lot_pre->products_item_id = $products_item_pre->id;
                    $stock_lot_pre->save();

                    $products_option_2_items = ProductsOption2Items::where('product_id',$products->id)->where('products_item_pre_id',$products_item_pre->id)->get();
                    foreach($products_option_2_items as $pro){
                        $stock_items_pre = new StockItemsPre();
                        $stock_items_pre->stock_lot_id = $stock_lot_pre->id;
                        $stock_items_pre->stock_id = $stock_pre->id;
                        $stock_items_pre->product_id = $products->id;
                        $stock_items_pre->customer_id = $products->customer_id;
                        $stock_items_pre->products_option_2_items_id = $pro->id;
                        $stock_items_pre->products_item_id = $products_item_pre->id;
                        // $stock_items_pre->name = $pro->name_th;

                        if($products_option_1->name_th!=''){
                            $stock_items_pre->name = $products->name_th.' : '.$products_option_1->name_th.' '.$products_option_2->name_th;
                        }else{
                            $stock_items_pre->name = $products->name_th;
                        }

                        $stock_items_pre->qty = 0;
                        $stock_items_pre->qty_booking = 0;
                        $stock_items_pre->price = $pro->price;
                        $stock_items_pre->save();
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

    public function api_product_store_more(Request $r)
    {
        DB::beginTransaction();
        try
            {

                $store = Store::where('customer_id',$r->user_id)->first();
                // $r->production_date = date('Y-m-d', strtotime($r->production_date));
                // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date));

                // เพิ่มสินค้าหลัก
                $products = Products::where('id',$r->product_id)->first();
                if(!$products){
                    return response()->json([
                        'message' =>  'ไม่พบรายการสินค้า',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
                // เพิ่ม item สินค้า storage_method_id brands_id
                $products_item = new ProductsItem();
                $products_item->product_id = $products->id;
                $products_item->customer_id = $r->user_id;
                $products_item->name_th = $products->name_th;
                $products_item->name_en = $products->name_en;
                $products_item->detail_th = $products->detail_th;
                $products_item->detail_en = $products->detail_en;
                // $products_item->category_id = $r->category_id;
                // $products_item->brands_id = $r->brands_id;
                $products_item->shelf_lift = $r->shelf_lift;
                // $products_item->storage_method_id = $r->storage_method_id;
                $products_item->store_id = $products->store_id;
                $products_item->price = $r->price;
                $products_item->qty = $r->qty;
                $products_item->stock_cut_off = $r->stock_cut_off;
                $products_item->production_date = $r->production_date;
                $products_item->shipping_date = $r->shipping_date;
                $products_item->products_code = $products->products_code;
                // $products_item->barcode = $products->barcode;
                $products_item->save();

                $products_option_head1 = new ProductsOptionHead();
                $products_option_head1->product_id = $products->id;
                $products_option_head1->option_type = 1;
                $products_option_head1->name_th = '';
                $products_option_head1->name_en = '';
                $products_option_head1->save();

                $products_option_head2 = new ProductsOptionHead();
                $products_option_head2->product_id = $products->id;
                $products_option_head2->option_type = 2;
                $products_option_head2->name_th = '';
                $products_option_head2->name_en = '';
                $products_option_head2->save();

                $products_option_1 = new ProductsOption1();
                $products_option_1->product_id = $products->id;
                $products_option_1->name_th = '';
                $products_option_1->name_en = '';
                $products_option_1->save();

                $products_option_2 = new ProductsOption2();
                $products_option_2->product_id = $products->id;
                $products_option_2->name_th = '';
                $products_option_2->name_en = '';
                $products_option_2->save();

                $products_option_2_items = new ProductsOption2Items();
                $products_option_2_items->product_id = $products->id;
                $products_option_2_items->products_item_id = $products_item->id;
                $products_option_2_items->option_1_id = $products_option_1->id;
                $products_option_2_items->option_2_id = $products_option_2->id;
                $products_option_2_items->price = $r->price;
                $products_option_2_items->qty = $r->qty;
                $products_option_2_items->name_th = '';
                $products_option_2_items->name_en = '';
                $products_option_2_items->save();

                $new_barcode = $this->generateRandomString(10);
                // $products_option_2_items->barcode = $products->barcode.$products_option_2_items->id;
                $products_option_2_items->barcode = $new_barcode;

                $products->min_price = $r->price;
                $products->max_price = $r->price;
                $products->save();

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
                            Storage::disk('public')->put('product/'.$products->customer_id.'/'.$products->id.'/' . $imageName, base64_decode($image));
                            // Storage::delete('file_payment/' . $check->file_slip);

                            $gal = new ProductsGallery();
                            $gal->path = 'product/'.$products->customer_id.'/'.$products->id.'/';
                            $gal->name = $imageName;
                            $gal->product_id = $products->id;
                            if($key==0){
                                $gal->use_profile = 1;
                            }else{
                                $gal->use_profile = 0;
                            }
                            $gal->save();
                            // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
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

    public function api_products_transfer_store(Request $r)
    {
        DB::beginTransaction();
        try
            {

                if($r->type == 'new'){
                    // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date)); is_preorder

                    $arr = explode(',',$r->arr_pro);
                    foreach($arr as $a){
                        if($a!=''){
                            $products_item = ProductsItem::where('id',$a)->first();
                            if($products_item){

                                $products_transfer = ProductsTransfer::where('product_id',$products_item->product_id)->where('products_item_id',$products_item->id)->first();
                                if(!$products_transfer){
                                    $products_transfer = new ProductsTransfer();
                                }
                                $products_transfer->product_id = $products_item->product_id;
                                $products_transfer->products_item_id = $products_item->id;
                                $products_transfer->transfer_type = 1;
                                $products_transfer->shipping_date = $r->shipping_date;
                                $products_transfer->tracking = $r->tracking;
                                $products_transfer->shipping_name = $r->shipping_name;
                                $products_transfer->shipping_type = $r->shipping_type;
                                $products_transfer->time_period = $r->time_period;
                                // $products_transfer->qty = $r->qty;
                                $products_transfer->qty = $products_item->qty;
                                if(isset($r->is_preorder)){
                                    $products_transfer->is_preorder = $r->is_preorder;
                                }
                                $products_transfer->save();

                                if($r->img!=''){
                                    Storage::disk('public')->delete('product/'.$products_item->customer_id.'/'.$products_item->id.'/' . $products_transfer->img);
                                    $image_64 = $r->img;
                                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                                    // find substring fro replace here eg: data:image/png;base64,
                                    $image = str_replace($replace, '', $image_64);
                                    $image = str_replace(' ', '+', $image);
                                    $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                                    Storage::disk('public')->put('product/'.$products_item->customer_id.'/'.$products_item->id.'/' . $imageName, base64_decode($image));
                                    $products_transfer->path_img = 'product/'.$products_item->customer_id.'/'.$products_item->id.'/';
                                    $products_transfer->img = $imageName;
                                    $products_transfer->save();
                                    // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                                }

                                $products_item->transfer_status = 2;
                                $products_item->transfer_status = 2;
                                $products_item->shipping_date = $r->shipping_date;
                                $products_item->save();

                                if(isset($r->is_preorder)){
                                    if($r->is_preorder==1){
                                        StockLotPre::where('product_id',$products_item->product_id)->where('cut_off',0)->update([
                                            'cut_off'=>1,
                                        ]);
                                    }
                                }

                            }
                        }

                    }

                }else{
                    $products_item = ProductsItem::where('id',$r->products_item_id)->first();
                    if($products_item){

                        $products_transfer = ProductsTransfer::where('product_id',$products_item->product_id)->where('products_item_id',$products_item->id)->first();
                        if(!$products_transfer){
                            $products_transfer = new ProductsTransfer();
                        }
                        $products_transfer->product_id = $products_item->product_id;
                        $products_transfer->products_item_id = $products_item->id;
                        $products_transfer->transfer_type = 1;
                        $products_transfer->shipping_date = $r->shipping_date;
                        $products_transfer->tracking = $r->tracking;
                        $products_transfer->shipping_name = $r->shipping_name;
                        $products_transfer->shipping_type = $r->shipping_type;
                        $products_transfer->time_period = $r->time_period;
                        $products_transfer->qty = $r->qty;
                        // $products_transfer->qty = $products_item->qty;
                        if(isset($r->is_preorder)){
                            $products_transfer->is_preorder = $r->is_preorder;
                        }
                        $products_transfer->save();

                        if($r->img!=''){
                            Storage::disk('public')->delete('product/'.$products_item->customer_id.'/'.$products_item->id.'/' . $products_transfer->img);
                            $image_64 = $r->img;
                            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                            // find substring fro replace here eg: data:image/png;base64,
                            $image = str_replace($replace, '', $image_64);
                            $image = str_replace(' ', '+', $image);
                            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                            Storage::disk('public')->put('product/'.$products_item->customer_id.'/'.$products_item->id.'/' . $imageName, base64_decode($image));
                            $products_transfer->path_img = 'product/'.$products_item->customer_id.'/'.$products_item->id.'/';
                            $products_transfer->img = $imageName;
                            $products_transfer->save();
                            // dd(Storage::disk('public')->url("{$gal->path}{$gal->name}"));
                        }

                        $products_item->transfer_status = 2;
                        $products_item->transfer_status = 2;
                        $products_item->shipping_date = $r->shipping_date;
                        $products_item->save();

                    }
                }

                // else{
                //     return response()->json([
                //         'message' =>  'ไม่พบข้อมูลสินค้า',
                //         'status' => 0,
                //         'data' => '',
                //     ]);
                // }

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

    public function api_check_cart_status(Request $r)
    {
        $cart = CustomerCart::select('status')->where('id',$r->cart_id)->first();
        if($cart){
            return response()->json([
                'message' => 'ทำรายการสำเร็จ',
                'status' => 1,
                'data' => [
                    'cart_status' => $cart->status,
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

    public function api_get_products_transfer_list(Request $r)
    {
        $store = Store::where('customer_id',$r->user_id)->first();
        if($store){
            $products_item = ProductsItem::select('products_item.id',
            'products_item.product_id',
            'products_item.qty',
            'products_item.created_at',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products.preorder_active',
            'products_item.name_th'
            )
            ->join('products_gallery','products_gallery.product_id','products_item.product_id')
            ->join('products','products.id','products_item.product_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.store_id',$store->id)
            ->where('products_item.transfer_status',1)
            ->where('products_item.approve_status',1)
            ->where('products_item.is_preorder',0)
            ->get();

            $url_img = Storage::disk('public')->url('');

                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => [
                        'products_item' => $products_item,
                        'url_img' => $url_img,
                    ],
                ]);
        }else{
            return response()->json([
                'message' =>  'ไม่พบข้อมูลผู้ใช้',
                'status' => 0,
                'data' => '',
            ]);
        }

    }

    public function api_get_products_transfer_list_pre(Request $r)
    {
        $store = Store::where('customer_id',$r->user_id)->first();
        if($store){
            $products_item = ProductsItem::select('products_item.id',
            'products_item.product_id',
            'products_item.qty',
            'products_item.created_at',
            'products_item.shipping_date',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products.preorder_active',
            'products_item.name_th'
            )
            ->join('products_gallery','products_gallery.product_id','products_item.product_id')
            ->join('products','products.id','products_item.product_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.store_id',$store->id)
            ->where('products_item.transfer_status',1)
            ->where('products_item.approve_status',1)
            ->where('products_item.is_preorder',1)
            ->get();

            $url_img = Storage::disk('public')->url('');

                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => [
                        'products_item' => $products_item,
                        'url_img' => $url_img,
                    ],
                ]);
        }else{
            return response()->json([
                'message' =>  'ไม่พบข้อมูลผู้ใช้',
                'status' => 0,
                'data' => '',
            ]);
        }

    }

    public function api_get_products_transfer_detail(Request $r)
    {
        $products_transfer = ProductsTransfer::where('products_item_id',$r->products_item_id)->first();
        if($products_transfer){

            $url_img = Storage::disk('public')->url('');

                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => [
                        'products_transfer' => $products_transfer,
                        'url_img' => $url_img,
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

}

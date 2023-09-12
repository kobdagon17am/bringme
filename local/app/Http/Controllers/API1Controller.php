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

    public function api_get_user(Request $r)
    {
        $user = Customer::where('id',$r->user_id)->first();
        if($user){
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $user,
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
        $data = DB::table('provinces')->where('business_location_id',1)->orderBy('name_th')->get();
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

    public function api_get_districts(Request $r)
    {
        $data = DB::table('districts')->where('amphure_id',$r->amphure_id)->orderBy('name_th')->get();
            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => $data,
            ]);
    }

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
                if($check_email){
                    return response()->json([
                        'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
                        'status' => 0,
                        'data' => '',
                    ]);
                }else{
                    $customer = new Customer();
                    $customer->name = $r->user_name;
                    $customer->email = $r->email;
                    $customer->birthday = $r->birthday;
                    $customer->tel = $r->tel;
                    $customer->password = Hash::make($r->password);
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

                    $brands = Brands::where('name_th',$r->brands)->first();
                    if(!$brands){
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
                    $store->address = $r->address2;
                    $store->province_id = $r->province_id2;
                    $store->amphures_id = $r->amphures_id2;
                    $store->district_id = $r->district_id2;
                    $store->zipcode = $r->zipcode2;
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

                }
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
                $product = CustomerCartProduct::where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->first();
                $stock_lot = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                ->where('qty','>',0)->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
                if(!$stock_lot){
                    return response()->json([
                        'message' =>  'จำนวนสินค้าไม่เพียงพอ',
                        'status' => 0,
                        'data' => '',
                    ]);
                }
                $stock_items = StockItems::where('product_id',$r->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                if($product){
                    // $product->customer_cart_id = $cart->id;
                    // $product->customer_id = $r->user_id;
                    // $product->product_id = $r->product_id;
                    $product->price = $stock_items->price;
                    if($r->type=='new'){
                        $product->total_price = ($stock_items->price*$r->qty);
                        $product->qty = $r->qty;
                    }else{
                        $product->total_price = ($stock_items->price*($r->qty+$product->qty));
                        $product->qty = ($r->qty+$product->qty);
                    }

                    $product->save();

                    // $qty_mis_total = $product->qty;
                    // if($qty_mis_total>0){
                    //     $stock_lot_arr = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                    //     ->where('qty','>',0)->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();
                    //     foreach($stock_lot_arr as $st_arr){
                    //         if($qty_mis_total > 0){
                    //             $stock_items = StockItems::where('product_id',$r->product_id)->where('stock_lot_id',$st_arr->id)->first();

                    //             $customer_cart_product_cut_stock = CustomerCartProductCutStock::select('id')->where('customer_cart_product_id',$product->id)->where('product_id',$r->product_id)->get();
                    //             if(count($customer_cart_product_cut_stock) > 1){
                    //                 CustomerCartProductCutStock::select('id')->where('customer_cart_product_id',$product->id)->where('product_id',$r->product_id)->delete();
                    //                 $customer_cart_product_cut_stock = new CustomerCartProductCutStock();
                    //             }else{
                    //                 $customer_cart_product_cut_stock = CustomerCartProductCutStock::where('customer_cart_product_id',$product->id)->where('product_id',$r->product_id)->first();
                    //             }
                    //             $customer_cart_product_cut_stock->customer_cart_product_id = $product->id;
                    //             $customer_cart_product_cut_stock->customer_cart_id = $cart->id;
                    //             $customer_cart_product_cut_stock->customer_id = $r->user_id;
                    //             $customer_cart_product_cut_stock->product_id = $r->product_id;
                    //             $customer_cart_product_cut_stock->stock_lot_id = $stock_items->stock_lot_id;
                    //             $customer_cart_product_cut_stock->stock_item_id = $stock_items->id;
                    //             $customer_cart_product_cut_stock->qty_need = $qty_mis_total;
                    //             if($stock_items->qty<$qty_mis_total){
                    //                 $customer_cart_product_cut_stock->qty_has = $stock_items->qty;
                    //             }else{
                    //                 $customer_cart_product_cut_stock->qty_has = $qty_mis_total;
                    //             }

                    //             $qty_mis_total = ($qty_mis_total-$stock_items->qty);
                    //             if($qty_mis_total < 0){
                    //                 $qty_mis_total = 0;
                    //             }

                    //             $customer_cart_product_cut_stock->qty_mis = $qty_mis_total;
                    //             $customer_cart_product_cut_stock->save();
                    //         }
                    //     }
                    // }

                    if($r->qty == 0){
                        CustomerCartProduct::where('customer_cart_id',$cart->id)->where('customer_id',$r->user_id)->where('product_id',$r->product_id)->delete();
                    }

                }else{
                    $product = new CustomerCartProduct();
                    $product->customer_cart_id = $cart->id;
                    $product->customer_id = $r->user_id;
                    $product->product_id = $r->product_id;
                    $product->price = $stock_items->price;
                    $product->total_price = ($stock_items->price*$r->qty);
                    $product->qty = $r->qty;
                    $product->save();

                    // $qty_mis_total = $r->qty;
                    //     if($qty_mis_total>0){
                    //         $stock_lot_arr = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                    //         ->where('qty','>',0)->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();
                    //         foreach($stock_lot_arr as $st_arr){
                    //             if($qty_mis_total > 0){
                    //                 $stock_items = StockItems::where('product_id',$r->product_id)->where('stock_lot_id',$st_arr->id)->first();

                    //                 $customer_cart_product_cut_stock = new CustomerCartProductCutStock();
                    //                 $customer_cart_product_cut_stock->customer_cart_product_id = $product->id;
                    //                 $customer_cart_product_cut_stock->customer_cart_id = $cart->id;
                    //                 $customer_cart_product_cut_stock->customer_id = $r->user_id;
                    //                 $customer_cart_product_cut_stock->product_id = $r->product_id;
                    //                 $customer_cart_product_cut_stock->stock_lot_id = $stock_items->stock_lot_id;
                    //                 $customer_cart_product_cut_stock->stock_item_id = $stock_items->id;
                    //                 $customer_cart_product_cut_stock->qty_need = $qty_mis_total;
                    //                 if($stock_items->qty<$qty_mis_total){
                    //                     $customer_cart_product_cut_stock->qty_has = $stock_items->qty;
                    //                 }else{
                    //                     $customer_cart_product_cut_stock->qty_has = $qty_mis_total;
                    //                 }

                    //                 $qty_mis_total = ($qty_mis_total-$stock_items->qty);
                    //                 if($qty_mis_total < 0){
                    //                     $qty_mis_total = 0;
                    //                 }

                    //                 $customer_cart_product_cut_stock->qty_mis = $qty_mis_total;
                    //                 $customer_cart_product_cut_stock->save();
                    //             }
                    //         }
                    //     }
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
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->join('store','store.id','products.store_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.transfer_status',3)
            ->where('products.display_status',1)
            ->orderBy('products.updated_at','desc')
            ->inRandomOrder()->get();

            $address = 'ยังไม่ระบุสถานที่จัดส่ง';
            if($r->user_id!=0){
                $customer_address = Customer_address::
                select('customer_address.*','districts.name_th as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
                ->join('districts','districts.id','customer_address.district_id')
                ->join('amphures','amphures.id','customer_address.amphures_id')
                ->join('provinces','provinces.id','customer_address.province_id')
                ->where('customer_id',$r->user_id)->where('default_active','Y')->first();
                if($customer_address){
                    $address = $customer_address->address_number.' '.$customer_address->districts_name.' '.$customer_address->amphures_name.' '.$customer_address->provinces_name.' '.$customer_address->zipcode;
                }
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
                ],
            ]);
    }

    public function api_get_product_detail(Request $r)
    {
        $product_detail = Products::where('id',$r->product_id)->first();
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
            $stock_lot = StockLot::select('lot_expired_date')->where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
            if($stock_lot){
                $lot_expired_date = date('d/m/Y', strtotime($stock_lot->lot_expired_date));
            }else{
                $lot_expired_date = '';
            }
            $stock_lot_all = StockLot::where('product_id',$r->product_id)->where('lot_expired_date','>',date('Y-m-d'))->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();
            $products_comment = ProductsComment::
            select('products_comment.*','customer.name as cus_name')
            ->join('customer','customer.id','products_comment.customer_id')
            ->where('products_comment.product_id',$r->product_id)
            ->orderBy('products_comment.created_at','desc')->get();

            $store->visitor_number = $store->visitor_number+1;
            $store->save();

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
                    'comment_number' => count($products_comment),
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
            ->where('customer_cart_product.customer_cart_id',$cart->id)->where('customer_cart_product.customer_id',$r->user_id)->get();
            foreach($products as $pro){
                $product_qty+=$pro->qty;
                if($pro->storage_method_id == 2){
                    $cold++;
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
            $shipping_type = DB::table('shipping_type')->whereNotIn('type',$arr_type_not)->get();

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'products' => $products,
                    'product_qty' => $product_qty,
                    'cart' => $cart,
                    'customer_address' => $customer_address,
                    'url_img' => $url_img,
                    'shipping_type' => $shipping_type,
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
        select('customer_address.*','districts.name_th as districts_name','amphures.name_th as amphures_name','provinces.name_th as provinces_name')
        ->join('districts','districts.id','customer_address.district_id')
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

         // ตะกร้า
         $cart->action_date = date('Y-m-d');
         $cart->pay_type = $r->pay_type;
         $cart->status = 0;
         $cart->order_number = 'BM'.date('Ym').str_pad($cart->id, 5, '0', STR_PAD_LEFT);
         $cart->shipping_date = date('Y-m-d');
         $cart->period = 2;
         $cart->customer_name = $customer->name;
         $cart->save();

        // บันทึกที่อยู่
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
            // cart_products_id
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
                $cart->shipping_date = date('Y-m-d');
                $cart->period = 2;
                $cart->customer_name = $customer->name;  $cart->shipping_type_id = $r->shipping_type_id;
                $cart->shipping_price = $r->shipping_price_total;
                $cart->total_price = $r->product_total_price;
                $cart->grand_total = $r->all_price_total;
                $cart->cart_products_id_arr = $r->cart_products_id;
                $cart->save();

                if($cart->status==2){
                    $cart_products_id = explode(',',$r->cart_products_id);
                    $arr_pro = CustomerCartProduct::select('customer_cart_product.*')
                    ->where('customer_cart_product.customer_cart_id',$r->cart_id)->whereIn('id',$cart_products_id)->where('customer_cart_product.customer_id',$r->user_id)->get();
                    foreach($arr_pro as $p){
                        $product = DB::table('products')->where('id',$p->product_id)->first();
                        if($product){
                            DB::table('products')->where('id',$product->id)->update([
                                'sale_number' => $product->sale_number + $p->qty,
                            ]);
                        }

                        $stock_lot = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                        ->where('qty','>',0)->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
                        if(!$stock_lot){
                            DB::rollback();
                            return response()->json([
                                'message' =>  'จำนวนสินค้าไม่เพียงพอ',
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                        // $stock_lot->qty_booking = $stock_lot->qty_booking-$p->qty;
                        // $stock_lot->save();
                        // $stock_items = StockItems::where('product_id',$p->product_id)->where('stock_lot_id',$stock_lot->id)->first();
                        // $stock_items->qty_booking = $stock_items->qty_booking-$p->qty;
                        // $stock_items->save();

                        // จองสต็อก
                        $qty_mis_total = $p->qty;
                        if($qty_mis_total>0){
                            $stock_lot_arr = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                            ->where('qty','>',0)->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->get();

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
                        }
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

    public function api_get_product_list(Request $r)
    {
        $customer = Customer::where('id',$r->user_id)->first();
        if($customer){
            $store = Store::where('customer_id',$r->user_id)->first();

            $product_last = Products::select('products.*','products_item.transfer_status',
            'products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            )
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            ->where('products_item.transfer_status',3)
            ->orderBy('products.updated_at','desc')
            ->get();

            $product_all = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            ->where('products_item.transfer_status',3)
            ->orderBy('products.updated_at','desc')
            ->get();

            $product_wait = Products::select('products.*','products_item.transfer_status','products_item.id as products_item_id','products_item.qty as products_item_qty',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',)
            ->join('products_item','products_item.product_id','products.id')
            ->join('products_gallery','products_gallery.product_id','products.id')
            ->where('products_gallery.use_profile',1)
            ->where('products.store_id',$store->id)
            ->where('products_item.transfer_status','!=',3)
            ->orderBy('products.updated_at','desc')
            ->get();

            $product_not_show = Products::where('store_id',$store->id)
            // ->where('approve_status',0)
            ->where('display_status',2)
            ->orderBy('updated_at','desc')
            ->get();

            $url_img = Storage::disk('public')->url('');

            return response()->json([
                'message' => 'สำเร็จ',
                'status' => 1,
                'data' => [
                    'customer' => $customer,
                    'store' => $store,
                    'product_last' => $product_last,
                    'product_all' => $product_all,
                    'product_wait' => $product_wait,
                    'product_not_show' => $product_not_show,
                    'url_img' => $url_img,
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
                // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date));

                // เพิ่มสินค้าหลัก
                $products = new Products();
                $products->name_th = $r->name_th;
                $products->name_en = $r->name_en;
                $products->name_th = $r->name_th;
                $products->detail_th = $r->name_th;
                $products->detail_en = $r->detail_en;
                $products->category_id = $r->category_id;
                $products->brands_id = $r->brands_id;
                // $products->shelf_lift = $r->shelf_lift;
                $products->storage_method_id = $r->storage_method_id;
                $products->store_id = $store->id;
                $products->customer_id = $r->user_id;
                // $products->price = $r->price;
                $products->qty = 0;
                // $products->stock_cut_off = $r->stock_cut_off;
                // $products->production_date = $r->production_date;
                // $products->shipping_date = $r->shipping_date;
                $products->save();

                $products_code = str_pad($products->id, 6, '0', STR_PAD_LEFT);
                $products->products_code = 'BM'.$products_code.'B';
                $products->barcode = $products->id.date('YmdHis');

                $products->save();

                // เพิ่ม item สินค้า storage_method_id brands_id
                $products_item = new ProductsItem();
                $products_item->product_id = $products->id;
                $products_item->customer_id = $r->user_id;
                $products_item->name_th = $r->name_th;
                $products_item->name_en = $r->name_en;
                $products_item->detail_th = $r->detail_th;
                $products_item->detail_en = $r->detail_en;
                // $products_item->category_id = $r->category_id;
                // $products_item->brands_id = $r->brands_id;
                $products_item->shelf_lift = $r->shelf_lift;
                // $products_item->storage_method_id = $r->storage_method_id;
                $products_item->store_id = $store->id;
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

                $products_option_2_items->barcode = $products->barcode.$products_option_2_items->id;
                $products_option_2_items->save();

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

                $products_option_2_items->barcode = $products->barcode.$products_option_2_items->id;

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
                // $r->shipping_date = date('Y-m-d', strtotime($r->shipping_date));
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
                    $products_transfer->qty = $r->qty;
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
                    $products_item->shipping_date = $r->shipping_date;
                    $products_item->save();

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
                    'data' => $products_item,
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

}

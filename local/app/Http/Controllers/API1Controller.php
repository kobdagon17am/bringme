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
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

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
                $customer->save();

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
                    //
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
                        $brand->name_th = $r->brands_th;
                        $brand->name_en = $r->brands_en;
                        $brand->save();
                    }

                    $store = new Store();
                    $store->customer_id = $customer->id;
                    $store->brands_id = $brand->id;
                    $store->category_id = $customer->category_id;
                    $store->save();


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
                'status' => 'success',
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
                    'status' => 'success',
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
                    'status' => 'success',
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
            return response()->json([
                'message' =>  'Insert New Address Successful.',
                'status' => 'success',
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
                'status' => 'success',
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
                'status' => 'success',
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
                'status' => 'success',
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

}

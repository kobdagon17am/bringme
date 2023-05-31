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

    //     DB::beginTransaction();
    //     try
    //     {

    //     $check_email = Customer::select('email')->where('email',$r->email)->first();
    //     if($check_email){
    //         return response()->json([
    //             'message' => 'email นี้ถูกใช้งานในระบบแล้วไม่สามารถใช้ซ้ำได้',
    //             'status' => 0,
    //             'data' => '',
    //         ]);
    //     }else{

    //         $customer = new Customer();
    //         $customer->firstname = $r->firstname;
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

    //         return response()->json([
    //             'message' => 'ทำรายการสำเร็จ กรุณารอการยืนยันจากระบบเพื่อใช้งานผ่าน email',
    //             'status' => 1,
    //             'data' => $customer,
    //         ]);

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
    // catch(\FatalThrowableError $fe)
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



}

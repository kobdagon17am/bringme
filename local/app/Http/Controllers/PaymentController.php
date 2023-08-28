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

class PaymentController extends Controller
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

    public function payment_form()
    {

        // dd($_GET['movement_id']);
        // $banners = Banner::get();
        // if(isset($_GET['movement_id'])){
        //     $movement_id = $_GET['movement_id'];
            // $payment = Payment::where('point_movement_id',$movement_id)->first();
            // $point_movement = PointMovement::where('id',$movement_id)->first();
            // $customer = Customer::where('id',$payment->customer_id)->first();
            // if($point_movement){
                return view('payment.payment_form',[
                    // 'payment'=>$payment,
                    // 'point_movement'=>$point_movement,
                    // 'customer'=>$customer,
                ]);
            // }
        // }

    }

    public function payment_complete(Request $r)
    {
        if($r->respCode=='0'){
            return view('payment.payment_complete',[
                'result_status'=>$r->status,
            ]);
        }else{
            return view('payment.payment_error',[
                'result_status'=>$r->status,
            ]);
        }

    }

    public function payment_complete_backend(Request $r)
    {

    //     DB::beginTransaction();
    //     try
    //     {

    //         $cart = CustomerCart::where('customer_id',$r->CustomerId)->where('status',0)->where('order_number',$r->OrderNo)->first();
    //             // $payment = Payment::where('id',$r->OrderNo)->first();
    //                 // if($payment){

    //                     $payment = new Payment();

    //                     $payment->pay_transaction_id = $r->TransactionId;
    //                     $payment->pay_amount = $r->Amount;
    //                     $payment->pay_order_no = $r->OrderNo;
    //                     $payment->pay_customer_id = $r->CustomerId;
    //                     $payment->pay_bank_code = $r->BankCode;
    //                     $payment->pay_payment_date = $r->PaymentDate;
    //                     $payment->pay_payment_status = $r->PaymentStatus;
    //                     $payment->pay_bank_ref_code = $r->BankRefCode;
    //                     $payment->pay_current_date = $r->CurrentDate;
    //                     $payment->pay_current_time = $r->CurrentTime;
    //                     $payment->pay_payment_discription = $r->PaymentDescription;
    //                     $payment->pay_credit_cart_token = $r->CreditCardToken;
    //                     $payment->pay_currency = $r->Currency;
    //                     $payment->pay_customer_name = $r->CustomerName;
    //                     $payment->pay_check_sum = $r->CheckSum;
    //                     if($r->PaymentStatus==0){
    //                         $payment->payment_status = 1;
    //                     }else{
    //                         $payment->payment_status = 2;
    //                     }
    //                     $payment->save();

    //                 // }

    //     DB::commit();

    //     return response()->json([
    //         'message' => 'เติมเงิน '.@$point_movement->name.' สำเร็จ',
    //         'status' => 1,
    //         // 'data' => $point_type,
    //     ]);
    // }
    //    catch (\Exception $e) {
    //        DB::rollback();
    //    // return $e->getMessage();
    //    return response()->json([
    //        'message' =>  $e->getMessage(),
    //        'status' => 0,
    //        'data' => '',
    //    ]);
    //    }
    //    catch(\FatalThrowableError $fe)
    //    {
    //        DB::rollback();
    //        return response()->json([
    //            'message' =>  $e->getMessage(),
    //            'status' => 0,
    //            'data' => '',
    //        ]);
    //    }

    }


}

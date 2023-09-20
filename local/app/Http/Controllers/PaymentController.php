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
Use App\Models\CustomerCartAddress;
Use App\Models\Payment;

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

        if(isset($_GET['cart_id'])){
            $cart = CustomerCart::where('id',$_GET['cart_id'])->first();
            if($cart){
                $customer_cart_address = CustomerCartAddress::where('customer_cart_id',$cart->id)->first();
                return view('payment.payment_form',[
                    'cart'=>$cart,
                    'customer_cart_address'=>$customer_cart_address,
                ]);
            }
        }

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


        DB::beginTransaction();
        try
        {
            $cart = CustomerCart::where('customer_id',$r->CustomerId)->where('status',0)->where('order_number',$r->OrderNo)->first();
            if($cart){
                $customer = Customer::select('name')->where('id',$r->CustomerId)->first();
                 // $payment = Payment::where('id',$r->OrderNo)->first();
                    // if($payment){
                        $payment = new Payment();
                        $payment->customer_id = $r->CustomerId;
                        $payment->customer_cart_id = $r->CustomerId;
                        $payment->customer_id = $r->CustomerId;

                        $payment->pay_transaction_id = $r->TransactionId;
                        $payment->pay_amount = $r->Amount;
                        $payment->pay_order_no = $r->OrderNo;
                        $payment->pay_customer_id = $r->CustomerId;
                        $payment->pay_bank_code = $r->BankCode;
                        $payment->pay_payment_date = $r->PaymentDate;
                        $payment->pay_payment_status = $r->PaymentStatus;
                        $payment->pay_bank_ref_code = $r->BankRefCode;
                        $payment->pay_current_date = $r->CurrentDate;
                        $payment->pay_current_time = $r->CurrentTime;
                        $payment->pay_payment_discription = $r->PaymentDescription;
                        $payment->pay_credit_cart_token = $r->CreditCardToken;
                        $payment->pay_currency = $r->Currency;
                        $payment->pay_customer_name = $r->CustomerName;
                        $payment->pay_check_sum = $r->CheckSum;
                        if($r->PaymentStatus==0){
                            $payment->payment_status = 1;
                        }else{
                            $payment->payment_status = 2;
                        }
                        $payment->save();

                        if($payment->payment_status == 1){
                            // if($cart->status==2){
                                $cart_products_id = explode(',',$cart->cart_products_id_arr);
                                $arr_pro = CustomerCartProduct::select('customer_cart_product.*')
                                ->where('customer_cart_product.customer_cart_id',$cart->id)->whereIn('id',$cart_products_id)->where('customer_cart_product.customer_id',$cart->customer_id)->get();
                                foreach($arr_pro as $p){

                                    $customer_cart_store = DB::table('customer_cart_store')->select('id')->where('customer_cart_id',$cart->id)->where('store_id',$p->store_id)->first();
                                    if(!$customer_cart_store){
                                        DB::table('customer_cart_store')->insert([
                                            'customer_cart_id' => $cart->id,
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
                                $cart_new->customer_id = $cart->customer_id;
                                $cart_new->shipping_type_id = 1;
                                $customer_address = Customer_address::
                                          select('customer_address.id')
                                ->where('customer_address.customer_id',$cart->customer_id)
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
                                ->where('customer_cart_product.customer_cart_id',$cart->id)->whereNotIn('id',$cart_products_id)->where('customer_cart_product.customer_id',$cart->customer_id)
                                ->update([
                                    'customer_cart_id' => $cart_new->id,
                                ]);

                                $cart->status = 2;
                                $cart->save();
                            // }

                        }else{
                            return response()->json([
                                'message' =>  'PaymentStatus : '.$r->PaymentStatus,
                                'status' => 0,
                                'data' => '',
                            ]);
                        }
                    // }
            }else{
                return response()->json([
                    'message' =>  'error',
                    'status' => 0,
                    'data' => '',
                ]);
            }

        DB::commit();

        return response()->json([
            'message' => 'สำเร็จ',
            'status' => 1,
            // 'data' => $point_type,
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

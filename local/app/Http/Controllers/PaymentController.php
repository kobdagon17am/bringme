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
use App\Models\StockPre;
use App\Models\StockItemsPre;
use App\Models\StockLotPre;
use Session;

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

     public function api_test(){
        try {

            $url = '103.208.27.85/APIGetData/APIGetData/GetSEllByData';
            $curl = curl_init($url);
            $fields = array(
                'Date' => '2023-10-01',
                'CheckSum' => 'f06b57aed7043bb4f0c148440aa98c31',
            );

            $fields_string = json_encode($fields);
            // $fields_string = http_build_query($fields);


            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: 16fk7b3a-db88-4d79-bzck-29e52attq541'
            ]);

            $response2 = curl_exec($curl);
            curl_close($curl);
            $response2 =  json_decode($response2);

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }

    public function register_partner(){$data['customer'] = Customer::all();
        $data['provinces'] = DB::table('provinces')->get();
        $data['amphures'] = DB::table('amphures')->get();
        // $data['districts'] = DB::table('districts')->get();
        $data['category'] = DB::table('category')->get();
        $data['storage_method'] = DB::table('storage_method')->get();
        $data['bank'] = DB::table('bank')->get();

        return view('backend.store-register-detail', $data);
    }

    public function get_amphures(Request $request){
        $data = DB::table('amphures')->where('province_id',$request->province_id)->orderBy('name_th')->get();
        $html = '<option value="">- เลือกเขต -</option>';
        if(!empty($data)){
            foreach ($data as $key => $_amphures) {
                $html .= '<option value="'.$_amphures->id.'">'.$_amphures->name_th.'</option>';
            }
        }
        return $html;
    }

    public function get_districes(Request $request){
        $data = DB::table('districts')->where('amphure_id',$request->amphures_id)->orderBy('name_th')->get();
        $html = '<option value="">- เลือกแขวง -</option>';
        if(!empty($data)){
            foreach ($data as $key => $_amphures) {
                $html .= '<option value="'.$_amphures->id.'">'.$_amphures->name_th.'</option>';
            }
        }
        return $html;
    }

    public function get_zipcode(Request $request){
        $data = DB::table('districts')->where('id',$request->district_id)->first();
        $html = $data->zip_code;
        return $html;
    }

    public function store_create(Request $request){
        $secretKey = '6LdPancoAAAAAHieEzrKOjI1b7Fzd2iP6IzfHRW1';
        $userResponse = $_POST['g-recaptcha-response'];
        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'secret' => $secretKey,
            'response' => $userResponse,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            die('cURL request failed: ' . curl_error($ch));
        }

        $data = json_decode($response);

        if ($data->success) {

            $customer = New Customer();
            $customer->name = $request->input('firstname');
            $customer->email = $request->input('email');
            $customer->birthday = $request->input('birthday');
            $customer->tel = $request->input('tel');
            $customer->password = Hash::make(!empty($request->input('password')) ? $request->input('password') : 'aaaa1111');
            $customer->customer_type = 2;
            $customer->select_type = 1;
            $customer->status = 1;
            $customer->address = $request->input('address');
            $customer->province_id = $request->input('province_id');
            $customer->amphures_id = $request->input('amphures_id');
            $customer->district_id = $request->input('district_id');
            $customer->zipcode = $request->input('zipcode');
            $customer->firstname = $request->input('firstname');
            $customer->save();

            if(!empty($request->file('profile_img'))){
                $profile_img = $request->file('profile_img');
                $extension = $profile_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('upload/profile/', $profile_img, $imageName, 'public');
                $customer->profile_img_path = 'upload/profile/';
                $customer->profile_img = $imageName;
                $customer->save();
            }

            $brands = Brands::where('name_th',$request->input('brand_name'))->first();
            if(!$brands){
                $brand = new Brands();
                $brand->name_th = $request->input('brand_name');
                $brand->name_en = $request->input('brand_name');
                $brand->has_store = 1;
                $brand->save();
            }else{
                $brand = $brands;
            }

            $store = New Store();
            $store->customer_id = $customer->id;
            $store->brands_id = $brand->id;
            $store->store_name = $request->input('store_name');
            $store->category_id = $request->input('category_id');
            $store->brand_product_detail = $request->input('brand_product_detail');
            $store->storage_method_id = $request->input('storage_method_id');
            $store->shelf_lift = $request->input('shelf_lift');
            $store->qty_sku = $request->input('qty_sku');
            $store->shipping_date = date('Y-m-d', strtotime($request->input('shipping_date')));
            $store->social = $request->input('social');
            $store->address = $request->input('address2');
            $store->province_id = $request->input('province_id2');
            $store->amphures_id = $request->input('amphures_id2');
            $store->district_id = $request->input('district_id2');
            $store->zipcode = $request->input('zipcode2');
            $store->bank_id = $request->input('bank_id');
            $store->bank_account_name = $request->input('bank_account_name');
            $store->bank_account_number = $request->input('bank_account_number');
            $store->save();

            if($request->file('product_ex_img') !=''){
                $product_ex_img = $request->file('product_ex_img');
                $extension = $product_ex_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $product_ex_img, $imageName, 'public');
                $store->product_ex_img_path = 'store/' . $store->id . '/';
                $store->product_ex_img = $imageName;
                $store->save();
            }

            if($request->file('product_pack_img') !=''){
                $product_pack_img = $request->file('product_pack_img');
                $extension = $product_pack_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $product_pack_img, $imageName, 'public');
                $store->product_pack_img_path = 'store/' . $store->id . '/';
                $store->product_pack_img = $imageName;
                $store->save();
            }

            if($request->file('certificate') !=''){
                $certificate = $request->file('certificate');
                $extension = $certificate->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $certificate, $imageName, 'public');
                $store->certificate_path = 'store/' . $store->id . '/';
                $store->certificate = $imageName;
                $store->save();
            }

            if($request->file('bank_img') !=''){
                $bank_img = $request->file('bank_img');
                $extension = $bank_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $bank_img, $imageName, 'public');
                $store->bank_img_path = 'store/' . $store->id . '/';
                $store->bank_img = $imageName;
                $store->save();
            }

            if($request->file('id_card_img') !=''){
                $id_card_img = $request->file('id_card_img');
                $extension = $id_card_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $id_card_img, $imageName, 'public');
                $store->id_card_img_path = 'store/' . $store->id . '/';
                $store->id_card_img = $imageName;
                $store->save();
            }

            if($request->file('company_img') !=''){
                $company_img = $request->file('company_img');
                $extension = $company_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $company_img, $imageName, 'public');
                $store->company_img_path = 'store/' . $store->id . '/';
                $store->company_img = $imageName;
                $store->save();
            }

            $gp_data['store_id'] = $store->id;
            $gp_data['percent'] = 10;
            $gp_data['status'] = '1';
            $gp_data['created_at'] = date('Y-m-d H:i:s');
            $gp = DB::table('bringme_percent_gp')->insert($gp_data);

            $customer = Customer::where('email',$request->input('email'))
            ->whereIn('status',[1,2])
            ->first();

            Auth::guard('customer')->login($customer);
            return redirect('home')->withSuccess('Register Success');
            //return redirect('login');
        }else{
            // die('reCAPTCHA verification failed');
            return redirect('register_partner')->withError('reCAPTCHA verification failed');
        }

    }

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

                                    // $stock_lot = StockLot::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))
                                    // ->where('qty_booking','>',0)->orderBy('lot_expired_date','asc')->first();
                                    // if(!$stock_lot){
                                    //     DB::rollback();
                                    //     return response()->json([
                                    //         'message' =>  'จำนวนสินค้าไม่เพียงพอ',
                                    //         'status' => 0,
                                    //         'data' => '',
                                    //     ]);
                                    // }

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
                                        $stock_lot = StockLotPre::where('product_id',$p->product_id)->where('lot_expired_date','>',date('Y-m-d'))->orderBy('lot_expired_date','asc')->first();
                                    }

                                    // จองสต็อก
                                    $qty_mis_total = $p->qty;
                                    if($qty_mis_total>0){
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
                                $cart->pay_status = 1;
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

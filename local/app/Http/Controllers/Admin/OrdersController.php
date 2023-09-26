<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use DataTables;
use App\User;
use File;
use Hash;
use App\Models\Store;
use App\Models\Brands;
use App\Models\Products;
use App\Models\Customer_address;
use App\Models\Category;
use App\Models\CustomerCartProduct;
use App\Models\CustomerCart;
use App\Mail\SendMail;
use App\Models\ProductsItem;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductsOptionHead;
use App\Models\ProductsOption1;
use App\Models\ProductsOption2;
use App\Models\ProductsOption2Items;
use App\Models\ProductsTransfer;
use App\Models\Stock;
use App\Models\StockLot;
use App\Models\StockShelf;
use App\Models\StockItems;
use App\Models\StockFloor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomerCartProductCutStock;
use App\Models\CustomerCartTracking;

class OrdersController extends  Controller
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

    public function order_list(Request $r)
    {


        // $stock_lot = StockLot::select('stock_lot.*','products.products_code','products.name_th as product_name')
        // ->join('products','products.id','stock_lot.product_id')
        // ->orderBy('store_id','asc')
        // ->orderBy('product_id','asc')
        // ->orderBy('lot_expired_date','asc')
        // ->get();
        // $customer_cart = CustomerCart::select('customer_cart.*', 'customer.name as cus_name')
        //     ->join('customer', 'customer.id', 'customer_cart.customer_id')
        //     ->where('customer_cart.status', 2)
        //     ->orderBy('customer_cart.order_number', 'desc')
        //     ->get();
        //     dd($customer_cart);


        return view('backend/orders');
    }


    public function order_datable(Request $request)
    {

        $customer_cart = CustomerCart::select('customer_cart.*', 'customer.name as cus_name')
            ->join('customer', 'customer.id', 'customer_cart.customer_id')
            ->where('customer_cart.status', 2)
            ->orderBy('customer_cart.order_number', 'desc');

        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($customer_cart);
        return $sQuery

            ->addColumn('picking_status', function ($row) {

                if ($row->picking_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })

            ->addColumn('scan_status', function ($row) {

                if ($row->scan_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })

            ->addColumn('transfer_status', function ($row) {

                if ($row->transfer_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })

            ->addColumn('transfer', function ($row) {
                //1.cod 2.โอน 3.บัตร
                if($row->pay_type == 1){
                    $text = 'ใช้ส่วนลด';
                }elseif($row->pay_type == 2){
                    $text = 'โอนชำระ';
                }elseif($row->pay_type == 3){
                    $text = 'บัตรเครดิต/บัตรเดบิต';
                }else{
                    $text = '';
                }
                $name = '<div class="whitespace-nowrap">'.$text.'</div>
                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">' . $row->action_date . '';

                return $name;
            })

            ->addColumn('grand_total', function ($row) {
                $grand_total = number_format($row->grand_total, 2);
                return $grand_total;
            })


            ->addColumn('action', function ($row) {
                $html = ' <div class="flex justify-center items-center">
                <a class="flex items-center mr-3 btn btn-sm btn-outline-primary" href="' . route('admin/order-detail', ['cart_id' => $row->id]) . '">  รายละเอียด </a>
           </div>';
                // <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>ลบ </a>
                return $html;
            })


            ->rawColumns(['picking_status', 'scan_status', 'transfer_status', 'transfer', 'action'])
            ->make(true);
    }



    public function order_detail($cart_id)
    {

        $resule =  \App\Http\Controllers\API2Controller::api_get_cart_detail_web($cart_id);
        if ($resule['status'] == 1) {

            return view('backend/order-detail', [
                'order_detail' => $resule
            ]);
        } else {
            return redirect('admin/orders')->withError('ไม่พบข้อมูลรายการ');
        }
    }




    // public function check_stock(Request $r){
    //     DB::beginTransaction();
    //     try
    //     {
    //             $cart = CustomerCart::where('id',$r->id)->first();
    //             if($cart->picking_status == 1 && $cart->scan_status == 1 && $cart->transfer_status == 1){
    //                 $cart->transfer_status = 2;
    //             }
    //             $cart->save();

    //         DB::commit();

    //         return response()->json([
    //             'message' =>  'สำเร็จ',
    //             'status' => 1,
    //             'data' => [
    //                 // 'cart' => $cart,
    //                 // 'product_cart' => $product_cart,
    //             ],
    //         ]);
    //     }
    //     catch (\Exception $e) {
    //         DB::rollback();
    //         // return $e->getMessage();
    //         return response()->json([
    //             'message' =>  $e->getMessage(),
    //             'status' => 0,
    //             'data' => '',
    //         ]);
    //     }
    //     catch(\FatalThrowableError $e)
    //     {
    //         DB::rollback();
    //         return response()->json([
    //             'message' =>  $e->getMessage(),
    //             'status' => 0,
    //             'data' => '',
    //         ]);
    //     }
    // }

}

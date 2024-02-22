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

use Barryvdh\DomPDF\Facade\Pdf;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Filesystem\Filesystem;

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

                if ($row->transfer_status == 2) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ได้รับสินค้าแล้ว </div>';
                } elseif($row->transfer_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';;
                }else{
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })

            ->addColumn('transfer', function ($row) {
                //1.cod 2.โอน 3.บัตร
                if($row->pay_type == 1){
                    $text = 'COD';
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


       $html = '<a href="'.route('admin/order-detail', ['cart_id' => $row->id]).'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียด</font> </a>';

                // <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>ลบ </a>
                return $html;
            })

            ->addColumn('print', function ($row) {

           $html = '<button onclick="print_pdf('.$row->id.')" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">Print</font> </button>';
                // <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>ลบ </a>
                return $html;
            })


            ->rawColumns(['picking_status', 'scan_status', 'transfer_status', 'transfer', 'action','print'])
            ->make(true);
    }



    public function order_detail($cart_id)
    {

        $resule =  \App\Http\Controllers\API2Controller::api_get_cart_detail_web($cart_id);
//dd($resule);

        if ($resule['status'] == 1) {

            return view('backend/order-detail', [
                'order_detail' => $resule
            ]);
        } else {
            return redirect('admin/orders')->withError('ไม่พบข้อมูลรายการ');
        }
    }




    public function order_print(Request $rs)
    {
        $file = new Filesystem;
        $file->cleanDirectory(public_path('order_list/'));

        $car_id = $rs->order_id;

        $customer_cart = DB::table('customer_cart_tracking')
        ->where('customer_cart_id',$car_id)
        ->whereNotNull('tracking_no')
        ->get();

        if(count($customer_cart) == 0){
            $data = ['status'=>'fail','url'=>'','ms'=>'ไม่พบข้อมูลใน customer_cart_tracking '];

            return  $data;
        }

        if(count($customer_cart) > 1){

        }else{
            $data =  \App\Http\Controllers\API2Controller::api_get_cart_detail_web($car_id);
            $status = 0;

            $pdf = PDF::loadView('backend.PDF.order_address', compact('data','status'));
            for ($i = 0; $i < 1; $i++) {
                $pathfile = public_path('order_list/'.$car_id.'_'.$i.'.pdf');
                $pdf->save($pathfile);

            }
        }

        $this->merger_pdf($car_id);
        $url =  asset('local/public/order/result_'.$car_id.'.pdf');
        $data = ['status'=>'success','url'=>$url];

         return $data;

    }

    public function order_print_api($cart_id)
    {

        // dd($cart_id);
        $file = new Filesystem;
        $file->cleanDirectory(public_path('order_list/'));



        $customer_cart = DB::table('customer_cart_tracking')
        ->where('customer_cart_id',$cart_id)
        ->whereNotNull('tracking_no')
        ->get();


        if(count($customer_cart) == 0){
            $data = ['status'=>'fail','url'=>'','ms'=>'ไม่พบข้อมูลใน customer_cart_tracking '];
            return  $data;
        }


        if(count($customer_cart) > 1){
            $data = ['status'=>'fail','url'=>'','ms'=>' กรณีหลายใบยังไม่เสร็จ '];

            return  $data;

        }else{
            $data =  \App\Http\Controllers\API2Controller::api_get_cart_detail_web($cart_id);
            $status = 0;

            $pdf = PDF::loadView('backend.PDF.order_address', compact('data','status'));
            // for ($i = 0; $i < 1; $i++) {
            //     $pathfile = public_path('order_list/'.$cart_id.'_'.$i.'.pdf');
            //     $pdf->save($pathfile);
            // }
        }

        // $this->merger_pdf($cart_id);
        return $pdf->stream();

        // $url_pdf =  asset('local/public/order/result_'.$cart_id);
        // $url = url('label/print_file/'.$cart_id);
        // $data = ['status'=>'success','url'=>$url,'ms'=>'success'];

        // return  $data;

    }

    public function order_print_api_stream($file_name)
    {
        $url_img = Storage::disk('public')->url('');
        // $url_pdf = asset('local/storage/app/public/order/result_'.$file_name.'.pdf');

        // return PDF::loadFile($url_img.'order/result_'.$file_name.'.pdf')->stream(date('YmdHis').'.pdf');
    }

    public function merger_pdf($item_id)
    {


        $pdf = PDFMerger::init();
        $files = scandir(public_path('order_list'));

        foreach ($files as $val) {
            if ($val != '.' && $val != '..') {
                $pdf->addPDF(public_path('order_list/' . $val), 'all');
            }
        }
        $pdf->merge();
        $fileName = public_path('order/' . 'result_'.$item_id.'.pdf');
        // return $pdf->stream();
        $pdf->save(($fileName));
        // $pdf->save(public_path($path_file));
        // $data_image = file_get_contents($path);
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

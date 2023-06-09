<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend/products');
    }

    public function products_waitapproved()
    {
        return view('backend/products-waitapproved');
    }

    public function products_waitapproved_detail($id='')
    {

        if(empty($id)){
            return redirect()->back()->withError('กรุณาเลือกร้านค้า');

        }

        $data = DB::table('products_item')
        ->select('products_item.*','customer.name as stor_name')

            ->where('products_item.id', $id)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->first();
        return view('backend/products-waitapproved-detail',compact('data','id'));
    }



    public function product_edit($id='')
    {

        if(empty($id)){
            return redirect()->back()->withError('กรุณาเลือกสินค้า');

        }
        $data = DB::table('products_item')
        ->select('products_item.*','customer.name as stor_name','products_transfer.id as transfer_id')

            ->where('products_item.id', $id)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_transfer', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->first();


        return view('backend/product-edit',compact('data'));
    }


    public function item_confirmation(Request $rs)
    {

        if($rs->tranfer_status == 3){
            // dd($rs->transfer_id);
           $data = \App\Http\Controllers\API2Controller::api_products_transfer_approve_backen($rs->transfer_id,$rs->date_in_stock,$rs->lot_expired_date,$rs->lot_number);

           if($data['status'] == 0 ){
            return redirect('admin/products')->withError($data['message']);
           }

           if($data['status'] == 1 ){
            return redirect('admin/products')->withSuccess('อัพเดทรายการสำเร็จ');
           }

        }else{
            try {
                DB::BeginTransaction();
                $dataPrepare = [
                    'transfer_status' => $rs->tranfer_status,

                ];
                $products_item = DB::table('products_item')
                    ->where('id', $rs->item_id)
                    ->update($dataPrepare);
                DB::commit();
                return redirect('admin/products')->withSuccess('อัพเดทรายการสำเร็จ');
            } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/products')->withError('อัพเดทรายการไม่สำเร็จ');
            }


        }


    }

    public function product_confirmation(Request $rs)
    {

        if($rs->type == 'confirm'){
            try {
                DB::BeginTransaction();
                $dataPrepare = [
                    'approve_status' => 1,
                    'transfer_status' => 1,

                ];
                $products_item = DB::table('products_item')
                    ->where('id', $rs->id)
                    ->update($dataPrepare);
                DB::commit();
                return redirect('admin/products-waitapproved')->withSuccess('อนุมัตรายการสำเร็จ');
            } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/products-waitapproved')->withError('อนุมัตรายการไม่สำเร็จ');
            }

        }elseif($rs->type == 'cancel'){
            try {
                DB::BeginTransaction();
                $dataPrepare = [
                    'approve_status' => 2,
                    'transfer_status' => 9,

                ];


                $products_item = DB::table('products_item')
                    ->where('id', $rs->id)
                    ->update($dataPrepare);
                DB::commit();
                return redirect('admin/products-waitapproved')->withSuccess('ยกเลิกรายการสำเร็จ');
            } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/products-waitapproved')->withError('ยกเลิกรายการไม่สำเร็จ');
            }

        }else{
            return redirect('admin/products-waitapproved')->withError('ยกเลิกรายการไม่สำเร็จ');

        }



    }



    public function products_waitapproved_datable(Request $request)
    {


        $products_item = DB::table('products_item')
        ->select('products_item.*','customer.name as stor_name')
            // ->where('status','=','success')
            // ->where('customer_type', 2)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->where('products_item.approve_status', 0);
            // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
            // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
            // ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($products_item);
        return $sQuery


            ->addColumn('img', function ($row) {

                $img = '<div class="flex">
                <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="' . asset('backend/dist/images/preview-9.jpg') . '">
                </div>
            </div>';

                return $img;
            })


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: '.$row->name_th.'</div>
                <div class="font-medium whitespace-nowrap">EN: '.$row->name_en.'</div>';

                return $name;
            })

            ->addColumn('stor_name', function ($row) {

                $name = $row->stor_name;

                return $name;
            })


            ->addColumn('qty', function ($row) {


                return number_format($row->qty,2);
            })


            ->addColumn('approve_status', function ($row) {

                if ($row->approve_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัต </div>';
                } elseif ($row->approve_status == 2) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })


            ->addColumn('transfer_status', function ($row) {

                if ($row->transfer_status == 0) {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                } elseif ($row->transfer_status == 1) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอจัดส่ง </div>';
                }elseif ($row->transfer_status == 2) {

                        $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>';
                 } elseif ($row->transfer_status == 3){

                        $htmml =  '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>';
                 } elseif ($row->transfer_status == 9) {

                        $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';

                }else {
                    $htmml = '<div class="flex text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })
            ->addColumn('action', function ($row) {



           $html = '<div class="flex justify-center items-center">
           <a class="flex items-center mr-3" href="'.route('admin/products-waitapproved-detail',['id'=>$row->id]).'"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
       </div>';
                return $html;
            })


            ->rawColumns(['product_name','approve_status','transfer_status', 'action', 'img'])
            ->make(true);
    }


    public function products_datable(Request $request)
    {


        $products_item = DB::table('products_item')
        ->select('products_item.*','customer.name as stor_name')
            // ->where('status','=','success')
            // ->where('customer_type', 2)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->where('products_item.approve_status','!=', 0);
            // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
            // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
            // ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($products_item);
        return $sQuery


            ->addColumn('img', function ($row) {

                $img = '<div class="flex">
                <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="' . asset('backend/dist/images/preview-9.jpg') . '">
                </div>
            </div>';

                return $img;
            })


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: '.$row->name_th.'</div>
                <div class="font-medium whitespace-nowrap">EN: '.$row->name_en.'</div>';

                return $name;
            })

            ->addColumn('stor_name', function ($row) {

                $name = $row->stor_name;

                return $name;
            })


            ->addColumn('qty', function ($row) {


                return number_format($row->qty,2);
            })


            ->addColumn('approve_status', function ($row) {

                if ($row->approve_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัต </div>';
                } elseif ($row->approve_status == 2) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })


            ->addColumn('transfer_status', function ($row) {

                if ($row->transfer_status == 0) {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                } elseif ($row->transfer_status == 1) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอจัดส่ง </div>';
                }elseif ($row->transfer_status == 2) {

                        $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>';
                 } elseif ($row->transfer_status == 3){

                        $htmml =  '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>';
                 } elseif ($row->transfer_status == 9) {

                        $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';

                }else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })

            ->addColumn('action', function ($row) {

                $html = ' <div class="flex justify-center items-center">
                <a class="flex items-center mr-3" href="'.route('admin/product-edit',['id'=>$row->id]).'"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข </a>
               <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>ลบ </a>
           </div>';
                return $html;
            })


            ->rawColumns(['product_name','approve_status','transfer_status', 'action', 'img'])
            ->make(true);
    }

}

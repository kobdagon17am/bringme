<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class ApprovePaymentController extends Controller
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
        return view('backend/approve_payment');
    }

    public function approve_payment_datatable(){
        $approve_payment = DB::table('customer_cart_claim');
        $sQuery = Datatables::of($approve_payment);
        return $sQuery

        ->addColumn('customer_cart_id', function ($row) {
            $order = DB::table('customer_cart')->where('id',$row->customer_cart_id)->first();
            return $order->order_number;
        })

        ->addColumn('customer_id', function ($row) {
            $customer = DB::table('customer')->where('id',$row->customer_id)->first();
            return $customer->name;
         })

         ->addColumn('status', function ($row) {
            $html = '';
            if($row->status == 0){
                $html = '<font color="orange">รอตรวจสอบ</font>';
            }elseif($row->status == 1){
                $html = '<font color="green">อนุมัติ</font>';
            }elseif($row->status == 2){
                $html = '<font color="red">ไม่อนุมัติ</font>';
            }
            return $html;
         })

         ->addColumn('action', function ($row) {
            $url = url('admin/approve_payment_view',['id'=>$row->id]);
            $url_unapprove = url('admin/approve_payment-unapprove',['id'=>$row->id]);
            $url_approve = url('admin/approve_payment-approve',['id'=>$row->id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">ตรวจสอบ</font> </a>';
            $html .= '<a  href="'.$url_unapprove.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2 confirm_action"> <font style="color: red;">ไม่อนุมัติ</font> </a>';
            $html .= '<a  href="'.$url_approve.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2 confirm_action"> <font style="color: green;">อนุมัติ</font> </a>';
            return $html;
         })

        ->rawColumns(['customer_cart_id','customer_id', 'status', 'action'])
        ->make(true);
    }

    public function approve_payment_view($id){
        return view('backend/approve_payment_detail');
    }

    public function approve_payment_unapprove($id){
        $data['status'] = 2;
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('customer_cart_claim')->where('id',$id)->update($data);
        return redirect('admin/approve_payment');
    }

    public function approve_payment_approve($id){
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('customer_cart_claim')->where('id',$id)->update($data);
        return redirect('admin/approve_payment');
    }


}

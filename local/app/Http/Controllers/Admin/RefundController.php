<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class RefundController extends Controller
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
        return view('backend/refund');
    }

    public function refund_datatable(){
        $refund = DB::table('customer_cart_claim');
        $sQuery = Datatables::of($refund);
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
            $url = url('admin/refund-view',['id'=>$row->id]);
            $url_unapprove = url('admin/refund-unapprove',['id'=>$row->id]);
            $url_approve = url('admin/refund-approve',['id'=>$row->id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">ตรวจสอบ</font> </a>';
            // $html .= '<a  href="'.$url_unapprove.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2 confirm_action"> <font style="color: red;">ไม่อนุมัติ</font> </a>';
            // $html .= '<a  href="'.$url_approve.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2 confirm_action"> <font style="color: green;">อนุมัติ</font> </a>';
            return $html;
         })

        ->rawColumns(['customer_cart_id','customer_id', 'status', 'action'])
        ->make(true);
    }

    public function refund_view($id){
        $refund = DB::table('customer_cart_claim')->where('id',$id)->first();
        $resule =  \App\Http\Controllers\API2Controller::api_get_cart_detail_web($refund->customer_cart_id);
        if ($resule['status'] == 1) {

            return view('backend/refund-detail', [
                'refund_id' => $id,
                'refund' => $refund,
                'order_detail' => $resule
            ]);
        } else {
            return redirect('admin/refund')->withError('ไม่พบข้อมูลรายการ');
        }
    }

    public function refund_unapprove($id){
        $data['status'] = 2;
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('customer_cart_claim')->where('id',$id)->update($data);
        return redirect('admin/refund');
    }

    public function refund_approve($id){
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('customer_cart_claim')->where('id',$id)->update($data);
        return redirect('admin/refund');
    }


}

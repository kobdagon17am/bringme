<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Storage;
use File;
use Hash;
use Illuminate\Support\Str;

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
        $approve_payment = DB::table('withdraw');
        $sQuery = Datatables::of($approve_payment);
        return $sQuery

        ->addColumn('store_id', function ($row) {
            $store = DB::table('store')->where('id',$row->store_id)->first();
            return $store->store_name;
        })

        ->addColumn('price', function ($row) {
            return $row->price;
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

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">ตรวจสอบ</font> </a>';
            return $html;
         })

        ->rawColumns(['store_id','price', 'status', 'action'])
        ->make(true);
    }

    public function approve_payment_view($id){
        $approve_payment = DB::table('withdraw')->where('id',$id)->first();
        if (!empty($approve_payment)) {
            return view('backend/approve_payment_detail', [
                'approve_payment_id' => $id,
                'approve_payment_detail' => $approve_payment
            ]);
        } else {
            return redirect('admin/approve_payment')->withError('ไม่พบข้อมูลรายการ');
        }
    }

    public function approve_payment_unapprove(Request $request){
        if($request->file('slip') !=''){
            $slip = $request->file('slip');
            $extension = $slip->getClientOriginalExtension();
            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
            Storage::disk('public')->putFileAs('slip/' . $request->input('id'), $slip, $imageName, 'public');
            $data['slip_path'] = 'slip/' . $request->input('id') . '/';
            $data['slip'] = $imageName;
        }
        $data['status'] = 2;
        $data['remark'] = $request->input('remark');
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('withdraw')->where('id',$request->input('id'))->update($data);

        $finance_movement = DB::Table('finance_movement')->where('ref_id',$request->input('id'))->first();
        $data_financial['status'] = 2;
        $data_financial['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('finance_movement')->where('ref_id',$request->input('id'))->update($data_financial);

        $store = DB::Table('store')->where('id',$finance_movement->store_id)->first();
        $data_store['credit'] = $store->credit + $finance_movement->price;
        $data_store['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('store')->where('id',$store->id)->update($data_store);

        
        return redirect('admin/approve_payment');
    }

    public function approve_payment_approve(Request $request){
        if($request->file('slip') !=''){
            $slip = $request->file('slip');
            $extension = $slip->getClientOriginalExtension();
            $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
            Storage::disk('public')->putFileAs('slip/' . $request->input('id'), $slip, $imageName, 'public');
            $data['slip_path'] = 'slip/' . $request->input('id') . '/';
            $data['slip'] = $imageName;
        }
        $data['status'] = 1;
        $data['remark'] = $request->input('remark');
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('withdraw')->where('id',$request->input('id'))->update($data);

        $data_financial['status'] = 1;
        $data_financial['updated_at'] = date('Y-m-d H:i:s');
        DB::Table('finance_movement')->where('ref_id',$request->input('id'))->update($data_financial);
        return redirect('admin/approve_payment');
    }


}

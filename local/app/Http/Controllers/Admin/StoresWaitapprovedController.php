<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class StoresWaitapprovedController extends Controller
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
        return view('backend/stores-waitapproved');
    }

    public function stores_confirmation(Request $rs)
    {


        $dataPrepare = [
            'approve_store' => $rs->status,

        ];

        try {
            DB::BeginTransaction();
            $get_unit = DB::table('customer')
                ->where('id', $rs->id)
                ->update($dataPrepare);
            DB::commit();
            return redirect('admin/stores-waitapproved')->withSuccess('ปรับสถานะสำเร็จ');
        } catch (Exception $e) {
            DB::rollback();
            return redirect('admin/stores-waitapproved')->withError('ปรับสถานะสำเร็จ');
        }
    }



    public function stores_waitapproved_datable(Request $request)
    {


        $customer = DB::table('customer')
            // ->where('status','=','success')
            ->where('customer_type', 2)
            ->where('approve_store', 0)
            ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
            ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
            ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($customer);
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

            ->addColumn('name_full', function ($row) {
                $name_full = $row->firstname . ' ' . $row->lat;
                return $name_full;
            })

            ->addColumn('status', function ($row) {

                if ($row->approve_store == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>';
                } elseif ($row->approve_store == 2) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Not Active </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Pending </div>';;
                }
                return $htmml;
            })

            ->addColumn('action', function ($row) {
                $url = route('admin/store-detail',['id'=>$row->id]);


                 $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียด</font> </a>';
                 return $html;
             })

            ->rawColumns(['status', 'action', 'img'])
            ->make(true);
    }
}

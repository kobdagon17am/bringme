<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class CustomersController extends Controller
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
        return view('backend/users');
    }

    public function customers_view($id){
        $data['customer'] = DB::table('customer')->where('id',$id)->first();
        $data['address'] = DB::table('customer_address')
                                ->where('customer_id',$id)
                                ->select('provinces.name_th as provinces_name', 'amphures.name_th as amphures_name', 'districts.name_th as districts_name', 'zipcode', 'address_number', 'tel')
                                ->leftJoin('provinces','provinces.id','=','customer_address.province_id')
                                ->leftJoin('amphures','amphures.id','=','customer_address.amphures_id')
                                ->leftJoin('districts','districts.id','=','customer_address.district_id')
                                ->get();
        return view('backend/user-edit',$data);
    }


    public function customers_datable(Request $request)
    {


        $customer = DB::table('customer')
        ->where('customer_type','=','1')
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

            ->addColumn('name', function ($row) {
               $name_full = $row->name;
                return $name_full;
            })

            ->addColumn('status', function ($row) {
                if($row->approve_store == 1){
                $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>' ;

                }elseif($row->approve_store == 2){

                $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Not Active </div>';

                }else{
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Paning </div>';;

                }
                 return $htmml;
             })

             ->addColumn('action', function ($row) {


                $url = url('admin/user-edit/'.$row->id);


                 $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียด</font> </a>';
                 return $html;
             })
            ->rawColumns(['img','status', 'action'])
            ->make(true);
    }



    public function block_user(Request $request){
        $data['approve_store'] = '2';
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::table('customer')->where('id',$request->input('customer_id'))->update($data);
        echo 'success';
    }
    public function unblock_user(Request $request){
        $data['approve_store'] = '1';
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::table('customer')->where('id',$request->input('customer_id'))->update($data);
        echo 'success';
    }
    public function approve_user(Request $request){
        $data['approve_store'] = '1';
        $data['updated_at'] = date('Y-m-d H:i:s');
        DB::table('customer')->where('id',$request->input('customer_id'))->update($data);
        echo 'success';
    }

}

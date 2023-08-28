<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class BrandsController extends Controller
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
        return view('backend/brands');
    }

    public function brands_datatable(Request $request)
    {
        $brands = DB::table('brands')->where('status','1');
        $sQuery = Datatables::of($brands);
        return $sQuery

        ->addColumn('name_th', function ($row) {
            return $row->name_th;
        })

        ->addColumn('name_en', function ($row) {
            return $row->name_en;
         })

        
        ->addColumn('action', function ($row) {
            $url = url('admin/setting-brands-edit',['id'=>$row->id]);
            $url_delete = url('admin/setting-brands-delete',['id'=>$row->id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">แก้ไข</font> </a>';
            $html .= '<button class="btn btn-sm btn-outline-primary mr-2 mb-2 delete-brands" url="'.$url_delete.'" data-tw-target="#delete-confirmation-modal"> <font style="color: red;">ลบ</font> </button>';
            return $html;
        })

        ->rawColumns(['name_th','name_en', 'action'])
        ->make(true);
    }


    public function brands_add(){
        return view('backend/brands-add');
    }

    public function brands_edit($id){
        $data['brands'] = DB::table('brands')->where('id',$id)->first();
        return view('backend/brands-add',$data);
    }

    public function brands_create(Request $request){
        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['status'] = '1';
        $data['created_at'] = date('Y-m-d H:i:s');
        DB::table('brands')->insert($data);
        return redirect('admin/setting-brands');
    }

    public function brands_update(Request $request){
        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('brands')->where('id',$request->input('id'))->update($data);
        return redirect('admin/setting-brands');
    }

    public function brands_delete($id){
        $data['status'] = 0;
        DB::table('brands')->where('id',$id)->update($data);
        return redirect('admin/setting-brands');
    }

}

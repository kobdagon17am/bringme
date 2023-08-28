<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class CategoryController extends Controller
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
        return view('backend/category');
    }

    public function category_datatable(Request $request)
    {
        $category = DB::table('category')->where('status','1');
        $sQuery = Datatables::of($category);
        return $sQuery

        ->addColumn('name_th', function ($row) {
            return $row->name_th;
        })

        ->addColumn('name_en', function ($row) {
            return $row->name_en;
         })

        
        ->addColumn('action', function ($row) {
            $url = url('admin/setting-category-edit',['id'=>$row->id]);
            $url_delete = url('admin/setting-category-delete',['id'=>$row->id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">แก้ไข</font> </a>';
            $html .= '<button class="btn btn-sm btn-outline-primary mr-2 mb-2 delete-category" url="'.$url_delete.'" data-tw-target="#delete-confirmation-modal"> <font style="color: red;">ลบ</font> </button>';
            return $html;
        })

        ->rawColumns(['name_th','name_en', 'action'])
        ->make(true);
    }


    public function category_add(){
        return view('backend/category-add');
    }

    public function category_edit($id){
        $data['category'] = DB::table('category')->where('id',$id)->first();
        return view('backend/category-add',$data);
    }

    public function category_create(Request $request){
        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['status'] = '1';
        $data['created_at'] = date('Y-m-d H:i:s');
        DB::table('category')->insert($data);
        return redirect('admin/setting-category');
    }

    public function category_update(Request $request){
        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('category')->where('id',$request->input('id'))->update($data);
        return redirect('admin/setting-category');
    }

    public function category_delete($id){
        $data['status'] = 0;
        DB::table('category')->where('id',$id)->update($data);
        return redirect('admin/setting-category');
    }

}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class PermissionController extends Controller
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
        return view('backend/permission');
    }

    public function permission_datatable(Request $request)
    {
        $permission = DB::table('permission');
        $sQuery = Datatables::of($permission);
        return $sQuery

        ->addColumn('name', function ($row) {
            return $row->permission_name;
        })

        ->addColumn('view', function ($row) {
            $html = '';
            if(!empty($row->permission_view)){
                $permission_view = json_decode($row->permission_view);
                if(!empty($permission_view)){
                    foreach ($permission_view as $key => $_view) {
                        $html .= $key.', ';
                    }
                }
                $html = substr($html, 0, -2);
            }else{
                $html = '-';
            }
            return $html;
         })

         ->addColumn('add', function ($row) {
            $html = '';
            if(!empty($row->permission_add)){
                $permission_add = json_decode($row->permission_add);
                if(!empty($permission_add)){
                    foreach ($permission_add as $key => $_add) {
                        $html .= $key.', ';
                    }
                }
                $html = substr($html, 0, -2);
            }else{
                $html = '-';
            }
            return $html;
         })

         ->addColumn('edit', function ($row) {
            $html = '';
            if(!empty($row->permission_edit)){
                $permission_edit = json_decode($row->permission_edit);
                if(!empty($permission_edit)){
                    foreach ($permission_edit as $key => $_edit) {
                        $html .= $key.', ';
                    }
                }
                $html = substr($html, 0, -2);
            }else{
                $html = '-';
            }
            return $html;
         })

         ->addColumn('delete', function ($row) {
            $html = '';
            if(!empty($row->permission_delete)){
                $permission_delete = json_decode($row->permission_delete);
                if(!empty($permission_delete)){
                    foreach ($permission_delete as $key => $_delete) {
                        $html .= $key.', ';
                    }
                }
                $html = substr($html, 0, -2);
            }else{
                $html = '-';
            }
            return $html;
         })

         ->addColumn('action', function ($row) {
            $url = url('admin/permission-edit',['id'=>$row->permission_id]);
            $url_delete = url('admin/permission-delete',['id'=>$row->permission_id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">แก้ไข</font> </a>';
            $html .= '<a  href="'.$url_delete.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: red;">ลบ</font> </a>';
            return $html;
         })

        ->rawColumns(['name','view', 'add', 'edit', 'delete', 'action'])
        ->make(true);
    }


    public function permission_add(){
        return view('backend/permission-add');
    }

    public function permission_edit($id){
        $permission = DB::table('permission')->where('permission_id',$id)->first();
        $data['permission'] = $permission;
        $data['permission_view'] = json_decode($permission->permission_view);
        $data['permission_add'] = json_decode($permission->permission_add);
        $data['permission_edit'] = json_decode($permission->permission_edit);
        $data['permission_delete'] = json_decode($permission->permission_delete);
        // dd($data['permission_add']);
        return view('backend/permission-edit',$data);
    }

    public function permission_create(Request $request){
        $data['permission_name'] = $request->input('permission_name');
        $data['permission_view'] = json_encode($request->input('permission_view'));
        $data['permission_add'] = json_encode($request->input('permission_add'));
        $data['permission_edit'] = json_encode($request->input('permission_edit'));
        $data['permission_delete'] = json_encode($request->input('permission_delete'));
        $data['permission_created'] = date('Y-m-d H:i:s');
        // dd($data);
        DB::table('permission')->insert($data);
        return redirect('admin/permission');
    }

    public function permission_update(Request $request){
        $data['permission_name'] = $request->input('permission_name');
        $data['permission_view'] = json_encode($request->input('permission_view'));
        $data['permission_add'] = json_encode($request->input('permission_add'));
        $data['permission_edit'] = json_encode($request->input('permission_edit'));
        $data['permission_delete'] = json_encode($request->input('permission_delete'));
        $data['permission_updated'] = date('Y-m-d H:i:s');

        DB::table('permission')->where('permission_id',$request->input('permission_id'))->update($data);
        return redirect('admin/permission');
    }

    public function permission_delete($id){
        $data['permission'] = DB::table('permission')->where('permission_id',$id)->delete();
        return redirect('admin/permission');
    }

}

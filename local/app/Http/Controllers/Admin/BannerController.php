<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Storage;
class BannerController extends Controller
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
        return view('backend/banner');
    }

    public function banner_datatable(Request $request)
    {
        $banner = DB::table('banner')->where('status','1')->orderBy('id','DESC');
        $sQuery = Datatables::of($banner);
        return $sQuery

        ->addColumn('img', function ($row) {
            $html = '<div class="w-10 h-10 image-fit zoom-in">';
            $html .= '<img class="rounded-full" src="'.(!empty($row) ? asset('local/storage/app/public').'/'.$row->path.'/'.$row->img : asset('backend/dist/images/profile-1.jpg')).'">';
            $html .= '<div>';
            return $html;
        })

        ->addColumn('name_th', function ($row) {
            return $row->name_th;
        })

        ->addColumn('name_en', function ($row) {
            return $row->name_en;
         })

        
        ->addColumn('action', function ($row) {
            $url = url('admin/setting-banner-edit',['id'=>$row->id]);
            $url_delete = url('admin/setting-banner-delete',['id'=>$row->id]);

            $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">แก้ไข</font> </a>';
            $html .= '<button class="btn btn-sm btn-outline-primary mr-2 mb-2 delete-banner" url="'.$url_delete.'" data-tw-target="#delete-confirmation-modal"> <font style="color: red;">ลบ</font> </button>';
            return $html;
        })

        ->rawColumns(['img', 'name_th','name_en', 'action'])
        ->make(true);
    }


    public function banner_add(){
        return view('backend/banner-add');
    }

    public function banner_edit($id){
        $data['banner'] = DB::table('banner')->where('id',$id)->first();
        return view('backend/banner-add',$data);
    }

    public function banner_create(Request $request){

        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['status'] = '1';
        $data['created_at'] = date('Y-m-d H:i:s');
        $banner_id = DB::table('banner')->insertGetID($data);

        if ($request->hasFile('banner_img')) {
            $imageFile = $request->file('banner_img');
            $extension = $imageFile->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            
            $disk = Storage::disk('public');
            $path = 'banner/' . $banner_id . '/' . $imageName;
            
            $disk->putFileAs('banner/' . $banner_id, $imageFile, $imageName, 'public');
            $data_img['path'] = 'banner/'.$banner_id.'/';
            $data_img['img'] = $imageName;
            DB::table('banner')->where('id',$banner_id)->update($data_img);
        }

        return redirect('admin/setting-banner');
    }

    public function banner_update(Request $request){

        $banner_id = $request->input('id');

        if ($request->hasFile('banner_img')) {
            $imageFile = $request->file('banner_img');
            $extension = $imageFile->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            
            $disk = Storage::disk('public');
            $path = 'banner/' . $banner_id . '/' . $imageName;
            
            $disk->putFileAs('banner/' . $banner_id, $imageFile, $imageName, 'public');
            $data_img['path'] = 'banner/'.$banner_id.'/';
            $data_img['img'] = $imageName;
            DB::table('banner')->where('id',$banner_id)->update($data_img);
        }

        $data['name_th'] = $request->input('name_th');
        $data['name_en'] = $request->input('name_en');
        $data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('banner')->where('id',$banner_id)->update($data);
        return redirect('admin/setting-banner');
    }

    public function banner_delete($id){
        $data['status'] = 0;
        DB::table('banner')->where('id',$id)->update($data);
        return redirect('admin/setting-banner');
    }

}

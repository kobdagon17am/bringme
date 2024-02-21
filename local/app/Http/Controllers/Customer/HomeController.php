<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('customer');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function __construct()
     {
         $this->middleware('customer');
     }
    public function index()
    {

        $id =  Auth::guard('customer')->user()->id;



        if($id){
            $data['id'] = $id;
            $data['store'] = DB::table('customer')->where('customer.id',$id)
                                ->leftJoin('provinces','provinces.id','=','customer.province_id')
                                ->leftJoin('amphures','amphures.id','=','customer.amphures_id')
                                // ->leftJoin('districts','districts.id','=','customer.district_id')
                                ->first();
            $data['store_detail'] = DB::table('store')->where('customer_id',$id)->first();
            $data['category'] = DB::table('category')->get();
            $data['storage_method'] = DB::table('storage_method')->get();
            $data['product'] = DB::table('products')
                                ->select('products.name_th as product_name_th','products.name_en as product_name_en', 'category.name_th as category_name_th','category.name_en as category_name_en','brands.name_th as brands_name_th','brands.name_en as brands_name_en','max_price','qty','approve_status','products_gallery.path as gallery_path','products_gallery.name as gallery_name','products_gallery.product_id','products.id','products_gallery.use_profile')
                                ->leftJoin('category','category.id','=','products.category_id')
                                ->leftJoin('brands','brands.id','=','products.brands_id')
                                ->leftJoin('products_gallery','products_gallery.product_id','=','products.id')
                                ->where('customer_id',$id)
                                ->where('products_gallery.use_profile','1')
                                ->get();



            $data['provinces'] = DB::table('provinces')->get();
            $data['amphures'] = DB::table('amphures')->get();
            // $data['districts'] = DB::table('districts')->get();
            $data['bank'] = DB::table('bank')->get();
            return view('frontend/home',$data);
        }else{

            Session::flush();
            Auth::guard('customer')->logout();


            return redirect('login')->withError(' Data Is Null');
        }



    }
}

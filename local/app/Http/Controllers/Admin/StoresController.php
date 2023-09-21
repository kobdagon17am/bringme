<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class StoresController extends Controller
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
        return view('backend/stores');
    }

    public function store_view($id){
        $data['store'] = DB::table('customer')->where('id',$id)->first();
        $data['address'] = DB::table('customer_address')
                                ->where('customer_id',$id)
                                ->select('provinces.name_th as provinces_name', 'amphures.name_th as amphures_name', 'districts.name_th as districts_name', 'zipcode', 'address_number', 'tel')
                                ->leftJoin('provinces','provinces.id','=','customer_address.province_id')
                                ->leftJoin('amphures','amphures.id','=','customer_address.amphures_id')
                                ->leftJoin('districts','districts.id','=','customer_address.district_id')
                                ->get();
        return view('backend/user-edit',$data);
    }


    public function store_detail($id)
    {
        if($id){
            $data['id'] = $id;
            $data['store'] = DB::table('customer')->where('customer.id',$id)
                                ->leftJoin('provinces','provinces.id','=','customer.province_id')
                                ->leftJoin('amphures','amphures.id','=','customer.amphures_id')
                                ->leftJoin('districts','districts.id','=','customer.district_id')
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
            $data['districts'] = DB::table('districts')->get();
            $data['bank'] = DB::table('bank')->get();
            return view('backend/store-detail',$data);
        }else{
            return redirect('admin/stores')->withError(' Data Is Null');
        }
    }

    public function store_update(Request $request){
        $customer = Customer::where('id',$request->input('customer_id'))->first();
        if($customer){
            
            $customer = Customer::find($request->input('customer_id'));
            $customer->name = $request->input('firstname');
            $customer->email = $request->input('email');
            $customer->birthday = $request->input('birthday');
            $customer->tel = $request->input('tel');
            $customer->customer_type = 2;
            $customer->select_type = 1;
            $customer->status = 1;
            $customer->address = $request->input('address');
            $customer->province_id = $request->input('province_id');
            $customer->amphures_id = $request->input('amphures_id');
            $customer->district_id = $request->input('district_id');
            $customer->zipcode = $request->input('zipcode');
            $customer->firstname = $request->input('firstname');
            $customer->save();

            $brands = Brands::where('name_th',$request->input('brand_name'))->first();
            if(!$brands){
                $brand = new Brands();
                $brand->name_th = $request->input('brand_name');
                $brand->name_en = $request->input('brand_name');
                $brand->has_store = 1;
                $brand->save();
            }

            $store = new Store();
            $store->customer_id = $customer->id;
            $store->brands_id = $brand->id;
            $store->store_name = $request->input('');
            $store->category_id = $request->input('category_id');
            $store->brand_product_detail = $r->brand_product_detail;
            $store->product_price = $r->product_price;
            $store->storage_method_id = $r->storage_method_id;
            $store->shelf_lift = $r->shelf_lift;
            $store->qty_sku = $r->qty_sku;
            $store->shipping_date = $r->shipping_date;
            $store->social = $r->social;
            $store->address = $r->address2;
            $store->province_id = $r->province_id2;
            $store->amphures_id = $r->amphures_id2;
            $store->district_id = $r->district_id2;
            $store->zipcode = $r->zipcode2;
            $store->bank_id = $r->bank_id;
            $store->bank_account_name = $r->bank_account_name;
            $store->bank_account_number = $r->bank_account_number;
            $store->save();

            if($r->product_ex_img!=''){
                $image_64 = $r->product_ex_img;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->product_ex_img_path = 'store/'.$store->id.'/';
                $store->product_ex_img = $imageName;
                $store->save();
            }

            if($r->product_pack_img!=''){
                $image_64 = $r->product_pack_img;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->product_pack_img_path = 'store/'.$store->id.'/';
                $store->product_pack_img = $imageName;
                $store->save();
            }

            if($r->certificate!=''){
                $image_64 = $r->certificate;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->certificate_path = 'store/'.$store->id.'/';
                $store->certificate = $imageName;
                $store->save();
            }

            if($r->bank_img!=''){
                $image_64 = $r->bank_img;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->bank_img_path = 'store/'.$store->id.'/';
                $store->bank_img = $imageName;
                $store->save();
            }

            if($r->id_card_img!=''){
                $image_64 = $r->id_card_img;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->id_card_img_path = 'store/'.$store->id.'/';
                $store->id_card_img = $imageName;
                $store->save();
            }

            if($r->company_img!=''){
                $image_64 = $r->company_img;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->put('store/'.$store->id.'/' . $imageName, base64_decode($image));
                $store->company_img_path = 'store/'.$store->id.'/';
                $store->company_img = $imageName;
                $store->save();
            }

        }else{
            return redirect('admin/stores')->withError(' Data Is Null');
        }
        return redirect('admin/stores-detail/'.$request->input('customer_id'));
    }


    public function stores_datable(Request $request)
    {


        $customer = DB::table('customer')
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
        ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));

        $sQuery = Datatables::of($customer);
        return $sQuery


            ->addColumn('img', function ($row) {
                $img = '<div class="flex">
                <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="'.(!empty($row->profile_img) ? asset('local/storage/app').'/'.$row->profile_img_path.''.$row->profile_img : asset('backend/dist/images/preview-9.jpg') ). '">
                </div>
            </div>';

                return $img;
            })

            ->addColumn('name_full', function ($row) {
               $name_full = $row->firstname.' '.$row->lat;
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
                $url = route('admin/store-detail',['id'=>$row->id]);


                 $html = '<a  href="'.$url.'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียด</font> </a>';
                 return $html;
             })


            ->rawColumns(['img','status', 'action'])
            ->make(true);
    }


}

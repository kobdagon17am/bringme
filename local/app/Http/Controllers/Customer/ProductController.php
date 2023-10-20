<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use DataTables;
use Storage;
use File;
use Hash;

use App\Models\Store;
use App\Models\Brands;
use App\Models\Products;
use App\Models\Customer_address;
use App\Models\Category;
use App\Models\CustomerCartProduct;
use App\Models\CustomerCart;
use App\Mail\SendMail;
use App\Models\ProductsItem;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductsOptionHead;
use App\Models\ProductsOption1;
use App\Models\ProductsOption2;
use App\Models\ProductsOption2Items;
use App\Models\ProductsTransfer;
use App\Models\Stock;
use App\Models\StockLot;
use App\Models\StockShelf;
use App\Models\StockItems;
use App\Models\ProductsGallery;
use Illuminate\Support\Str;
use App\Models\CustomerCartProductCutStock;
use App\Models\ProductsComment;
use App\Models\CustomerCartAddress;
use Barryvdh\DomPDF\Facade\Pdf;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Filesystem\Filesystem;
class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {


    //     return view('Customer/product-edit');
    // }

    public function product_edit($id)
    {

        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกสินค้า');
        }

        $data['products_item'] = DB::table('products_item')
            ->select('products_item.*', 'products_item.id as item_id', 'customer.name as store_name', 'products_transfer.id as transfer_id', 'products.category_id', 'products.brands_id', 'products.store_id as store_id', 'products.storage_method_id')
            ->where('products_item.product_id', $id)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_transfer', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->first();

        $data['gallery'] = DB::table('products_gallery')->where('product_id', $data['products_item']->item_id)->get();
        $data['category'] = DB::table('category')->get();
        $data['brands'] = DB::table('brands')->get();
        $data['brands_select'] = DB::table('brands')->where('id', $data['products_item']->brands_id)->first();

        $data['products_option_head'] = DB::table('products_option_head')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_1'] = DB::table('products_option_1')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_2'] = DB::table('products_option_2')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_2_items'] = DB::table('products_option_2_items')->where('product_id', $data['products_item']->product_id)->get();

        return view('frontend/product-edit', $data);
    }

    public function product_detail($id)
    {

        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกสินค้า');
        }

        $data['products_item'] = DB::table('products_item')
            ->select('products_item.*', 'products_item.id as item_id', 'customer.name as store_name', 'products_transfer.id as transfer_id', 'products.category_id', 'products.brands_id', 'products.store_id as store_id', 'products.storage_method_id')
            ->where('products_item.product_id', $id)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_transfer', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->first();

        $data['gallery'] = DB::table('products_gallery')->where('product_id', $data['products_item']->item_id)->get();
        $data['category'] = DB::table('category')->get();
        $data['brands'] = DB::table('brands')->get();
        $data['brands_select'] = DB::table('brands')->where('id', $data['products_item']->brands_id)->first();

        $data['products_option_head'] = DB::table('products_option_head')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_1'] = DB::table('products_option_1')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_2'] = DB::table('products_option_2')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_2_items'] = DB::table('products_option_2_items')->where('product_id', $data['products_item']->product_id)->get();

        return view('frontend/product-detail', $data);
    }

    public function product_panding_tranfer_detail($id = '')
    {
        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกสินค้า');
        }

        $data['data'] = DB::table('products_item')
            ->select(
                'products_item.*',
                'customer.name as stor_name',
                'brands.name_th as brand_name',
                'customer.tel',
                'products.category_id as category_id',

            )
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brands_id')
            ->where('products_item.product_id', '=', $id)
            ->first();


        $data['gallery'] = DB::table('products_gallery')->where('product_id',$id)->get();
        $data['category'] = DB::table('category')->get();
        $data['shelf'] = DB::table('dataset_shelf')->get();

        return view('frontend/product-panding-tranfer-detail', $data);
    }


    public function item_gallery(Request $request)
    {

        if ($request->hasFile('gallery_file')) {
            $products = DB::table('products_item')->where('product_id', $request->input('item_id'))->first();
            foreach ($request->file('gallery_file') as $key => $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;

                $disk = Storage::disk('public');
                $path = 'product/' . $products->customer_id . '/' . $products->id . '/' . $imageName;

                $disk->putFileAs('product/' . $products->customer_id . '/' . $products->id, $imageFile, $imageName, 'public');
                $data_img['product_id'] = $products->id;
                $data_img['path'] = 'product/' . $products->customer_id . '/' . $products->id . '/';
                $data_img['name'] = $imageName;
                $data_img['use_profile'] = 1;
                $data_img['created_at'] = date('Y-m-d H:i:s');
                $data_img['updated_at'] = date('Y-m-d H:i:s');
                DB::table('products_gallery')->insert($data_img);
            }
        }

        return redirect('product-edit/' . $request->input('item_id'));
    }


    public function product_update(Request $request)
    {

        // dd($request->input() , $request->file());

        $products_item = DB::table('products_item')->where('id', $request->input('item_id'))->first();
        $store = DB::table('store')->where('id', $products_item->store_id)->first();
        $brands = DB::table('brands')->where('name_th', 'LIKE', $request->input('brands_id'))->first();
        $brands_id = null;
        if (!empty($brands)) {
            $brands_id = $brands->id;
        } else {
            $data['name_th'] = $request->input('brands_id');
            $data['name_en'] = $request->input('brands_id');
            $data['status'] = 1;
            $data['has_store'] = 1;
            $brands_id = DB::table('brands')->insertGetID($data);
        }

        // อัพเดตสินค้าหลัก
        $products = Products::find($products_item->product_id);
        $products->name_th = $request->input('name_th');
        $products->name_en = $request->input('name_en');
        $products->detail_th = $request->input('detail_th');
        $products->detail_en = $request->input('detail_en');
        $products->category_id = $request->input('category_id');
        $products->brands_id = $brands_id;
        $products->storage_method_id = $request->input('storage_method_id');
        $products->store_id = $store->id;
        $products->customer_id = $store->customer_id;
        $products->qty = $request->input('product_qty');
        $products->save();

        // $products_code = str_pad($products->id, 6, '0', STR_PAD_LEFT);
        // $products->products_code = 'BM'.$products_code.'B';
        // $products->barcode = $products->id.date('YmdHis');
        // $products->save();

        // อะพเดต item สินค้า storage_method_id brands_id
        $products_item = ProductsItem::find($products_item->id);
        // $products_item->product_id = $products->id;
        $products_item->customer_id = $store->customer_id;
        $products_item->name_th = $request->input('name_th');
        $products_item->name_en = $request->input('name_en');
        $products_item->detail_th = $request->input('detail_th');
        $products_item->detail_en = $request->input('detail_en');
        $products_item->shelf_lift = (!empty($request->input('shelf_lift')) ? $request->input('shelf_lift') : 15);
        $products_item->store_id = $store->id;
        $products_item->price = $request->input('product_price');
        $products_item->qty = $request->input('product_qty');
        $products_item->stock_cut_off = (!empty($request->input('stock_cut_off')) ? $request->input('stock_cut_off') : 10);
        $products_item->production_date = (!empty($request->input('production_date')) ? $request->input('production_date') : date('Y-m-d'));
        $products_item->shipping_date = (!empty($request->input('shipping_date')) ? $request->input('shipping_date') : date('Y-m-d'));
        // $products_item->products_code = $products->products_code;
        $products_item->save();

        ProductsOptionHead::where('product_id',$products_item->product_id)->delete();
        ProductsOption1::where('product_id',$products_item->product_id)->delete();
        ProductsOption2::where('product_id',$products_item->product_id)->delete();
        ProductsOption2Items::where('product_id',$products_item->product_id)->delete();
        $option_type = 1;
        if (!empty($request->input('option_title'))) {
            foreach ($request->input('option_title') as $key => $_option_title) {
                $products_option_head1 = new ProductsOptionHead();
                $products_option_head1->product_id = $products->id;
                $products_option_head1->option_type = $option_type;
                $products_option_head1->name_th = $_option_title;
                $products_option_head1->name_en = $_option_title;
                $products_option_head1->save();
                $option_type++;
            }
        }

        $array_max_min = array();
        $id_option_1 = array();
        $id_option_2 = array();

        if (!empty($request->input('option_detail'))) {
            foreach ($request->input('option_detail') as $key => $_option_detail) {
                $products_option_1 = new ProductsOption1();
                $products_option_1->product_id = $products->id;
                $products_option_1->name_th = $_option_detail;
                $products_option_1->name_en = $_option_detail;
                $products_option_1->save();
                array_push($id_option_1, $products_option_1->id);
            }
        }

        if (!empty($request->input('option_detail_2'))) {
            foreach ($request->input('option_detail_2') as $key => $_option_detail_2) {
                $products_option_2 = new ProductsOption2();
                $products_option_2->product_id = $products->id;
                $products_option_2->name_th = $_option_detail_2;
                $products_option_2->name_en = $_option_detail_2;
                $products_option_2->save();
                array_push($id_option_2, $products_option_2->id);
            }
        }

        // dd($id_option_1, $id_option_2);

        if(!empty($request->input('option_detail')[0])){
            foreach ($request->input('option_detail') as $key_1 => $_option_detail) {
                if(!empty($_option_detail) && !empty($request->input('option_detail_2')[0])){
                    foreach ($request->input('option_detail_2') as $key_2 => $_option_detail_2) {
                        if(!empty($_option_detail_2)){
                            $products_option_2_items = new ProductsOption2Items();
                            $products_option_2_items->product_id = $products->id;
                            $products_option_2_items->products_item_id = $products_item->id;
                            $products_option_2_items->option_1_id = $id_option_1[$key_1];
                            $products_option_2_items->option_2_id = $id_option_2[$key_2];
                            $products_option_2_items->price = $request->input('price')[$_option_detail][$_option_detail_2][0];
                            $products_option_2_items->qty = $request->input('stock')[$_option_detail][$_option_detail_2][0];
                            $products_option_2_items->name_th = $_option_detail . ' ' . $_option_detail_2;
                            $products_option_2_items->name_en = $_option_detail . ' ' . $_option_detail_2;
                            $products_option_2_items->save();

                            $products_option_2_items->barcode = $products->barcode . $products_option_2_items->id;
                            $products_option_2_items->save();

                            if (!in_array($request->input('price')[$_option_detail][$_option_detail_2][0], $array_max_min)) {
                                array_push($array_max_min, $request->input('price')[$_option_detail][$_option_detail_2][0]);
                            }
                        }
                    }
                }elseif(!empty($_option_detail)){
                    $key_2 = 0;
                    $products_option_2_items = new ProductsOption2Items();
                    $products_option_2_items->product_id = $products->id;
                    $products_option_2_items->products_item_id = $products_item->id;
                    $products_option_2_items->option_1_id = $id_option_1[$key_1];
                    $products_option_2_items->option_2_id = $id_option_2[$key_2];
                    $products_option_2_items->price = $request->input('price')[$_option_detail][$_option_detail_2][0];
                    $products_option_2_items->qty = $request->input('stock')[$_option_detail][$_option_detail_2][0];
                    $products_option_2_items->name_th = $_option_detail . ' ' . $_option_detail_2;
                    $products_option_2_items->name_en = $_option_detail . ' ' . $_option_detail_2;
                    $products_option_2_items->save();

                    $products_option_2_items->barcode = $products->barcode . $products_option_2_items->id;
                    $products_option_2_items->save();

                    if (!in_array($request->input('price')[$_option_detail][$_option_detail_2][0], $array_max_min)) {
                        array_push($array_max_min, $request->input('price')[$_option_detail][$_option_detail_2][0]);
                    }
                }
            }
        }

        $products->min_price = min($array_max_min);
        $products->max_price = max($array_max_min);
        $products->save();


        DB::commit();
        return redirect('product-edit/' .$products_item->product_id);
        // if(!empty(Auth::guard('admin')->user()->name)){
        //     return redirect('admin/store-detail/' . $products_item->customer_id);
        // }else{
        //     return redirect('backend/store-detail/' . $products_item->customer_id);
        // }
    }





    public function products_pending_tranfer()
    {
        // $products_item = DB::table('products_item')
        // ->select('products_item.*', 'customer.name as stor_name')
        // ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
        // ->wherein('products_item.transfer_status', [0,1])
        // ->where('customer.id',Auth::guard('customer')->user()->id)->get();
        // dd($products_item );
        return view('frontend/products-pending-tranfer');
    }

    public function products_pending_tranfer_datatable(Request $request)
    {


        $products_item = DB::table('products_item')
        ->select('products_item.*', 'customer.name as stor_name')
        ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
        ->wherein('products_item.transfer_status', [0,1])
        ->where('customer.id',Auth::guard('customer')->user()->id);


        $sQuery = Datatables::of($products_item);
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


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: ' . $row->name_th . '</div>
                <div class="font-medium whitespace-nowrap">EN: ' . $row->name_en . '</div>';

                return $name;
            })


            ->addColumn('qty', function ($row) {


                return number_format($row->qty, 2);
            })


            ->addColumn('approve_status', function ($row) {

                if ($row->approve_status == 1) {
                    $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';
                } elseif ($row->approve_status == 2) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
                }
                return $htmml;
            })


            ->addColumn('transfer_status', function ($row) {

                if ($row->transfer_status == 0) {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                } elseif ($row->transfer_status == 1) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอจัดส่ง </div>';
                } elseif ($row->transfer_status == 2) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>';
                } elseif ($row->transfer_status == 3) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>';
                } elseif ($row->transfer_status == 9) {

                        $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';

                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })

            ->addColumn('action', function ($row) {
                if($row->transfer_status == 1){
                    $html = '<a href="'.  route('product-panding-tranfer-detail', ['id' => $row->product_id])   . '" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">ทำรายการจัดส่งสินค้า</font> </a>';
                }else{
                    $html = '<a href="'.route('product-detail', ['id' => $row->product_id]). '" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียดสินค้า</font> </a>';
                }


                return $html;
            })


            ->rawColumns(['product_name', 'approve_status', 'transfer_status', 'action', 'img'])
            ->make(true);
    }

    public function product_create(Request $request)
    {

        // dd($request->input() , $request->file() );

        $store = DB::table('store')->where('customer_id', $request->input('store_id'))->first();
        $brands = DB::table('brands')->where('name_th', 'LIKE', $request->input('brands_id'))->first();
        $brands_id = null;
        if (!empty($brands)) {
            $brands_id = $brands->id;
        } else {
            $data['name_th'] = $request->input('brands_id');
            $data['name_en'] = $request->input('brands_id');
            $data['status'] = 1;
            $data['has_store'] = 1;
            $brands_id = DB::table('brands')->insertGetID($data);
        }

        // เพิ่มสินค้าหลัก
        $products = new Products();
        $products->name_th = $request->input('name_th');
        $products->name_en = $request->input('name_en');
        $products->detail_th = $request->input('detail_th');
        $products->detail_en = $request->input('detail_en');
        $products->category_id = $request->input('category_id');
        $products->brands_id = $brands_id;
        $products->min_price = 0;
        $products->max_price = 0;
        $products->shipping_price = 0;

        $products->storage_method_id = $request->input('storage_method_id');
        $products->store_id = $store->id;
        $products->customer_id = $store->customer_id;
        $products->qty = $request->input('product_qty');
        $products->save();

        $products_code = str_pad($products->id, 6, '0', STR_PAD_LEFT);
        $products->products_code = 'BM' . $products_code . 'B';
        $products->barcode = $products->id . date('YmdHis');
        $products->save();

        // เพิ่ม item สินค้า storage_method_id brands_id
        $products_item = new ProductsItem();
        $products_item->product_id = $products->id;
        $products_item->rate = 0;

        $products_item->customer_id = $store->customer_id;
        $products_item->name_th = $request->input('name_th');
        $products_item->name_en = $request->input('name_en');
        $products_item->detail_th = $request->input('detail_th');
        $products_item->detail_en = $request->input('detail_en');
        $products_item->shelf_lift = (!empty($request->input('shelf_lift')) ? $request->input('shelf_lift') : 15);
        $products_item->store_id = $store->id;
        $products_item->price = $request->input('price')[0][0][0];
        $products_item->qty = $request->input('product_qty');
        $products_item->stock_cut_off = (!empty($request->input('stock_cut_off')) ? $request->input('stock_cut_off') : 10);
        $products_item->production_date = (!empty($request->input('production_date')) ? $request->input('production_date') : date('Y-m-d'));
        $products_item->shipping_date = (!empty($request->input('shipping_date')) ? $request->input('shipping_date') : date('Y-m-d'));
        $products_item->products_code = $products->products_code;
        $products_item->save();

        if (!empty($request->input('option_title'))) {
            foreach ($request->input('option_title') as $key => $_option_title) {
                $products_option_head1 = new ProductsOptionHead();
                $products_option_head1->product_id = $products->id;
                $products_option_head1->option_type = $key + 1;
                $products_option_head1->name_th = $_option_title;
                $products_option_head1->name_en = $_option_title;
                $products_option_head1->save();
            }
        }

        $array_max_min = array();
        $id_option_1 = array();
        $id_option_2 = array();

        if (!empty($request->input('option_detail'))) {
            foreach ($request->input('option_detail') as $key => $_option_detail) {
                $products_option_1 = new ProductsOption1();
                $products_option_1->product_id = $products->id;
                $products_option_1->name_th = $_option_detail;
                $products_option_1->name_en = $_option_detail;
                $products_option_1->save();
                array_push($id_option_1, $products_option_1->id);
            }
        }

        if (!empty($request->input('option_detail_2'))) {
            foreach ($request->input('option_detail_2') as $key => $_option_detail_2) {
                $products_option_2 = new ProductsOption2();
                $products_option_2->product_id = $products->id;
                $products_option_2->name_th = $_option_detail_2;
                $products_option_2->name_en = $_option_detail_2;
                $products_option_2->save();
                array_push($id_option_2, $products_option_2->id);
            }
        }

        // dd($id_option_1, $id_option_2);

        if(!empty($request->input('option_detail')[0])){
            foreach ($request->input('option_detail') as $key_1 => $_option_detail) {
                if(!empty($_option_detail) && !empty($request->input('option_detail_2')[0])){
                    foreach ($request->input('option_detail_2') as $key_2 => $_option_detail_2) {
                        if(!empty($_option_detail_2)){
                            $products_option_2_items = new ProductsOption2Items();
                            $products_option_2_items->product_id = $products->id;
                            $products_option_2_items->products_item_id = $products_item->id;
                            $products_option_2_items->option_1_id = $id_option_1[$key_1];
                            $products_option_2_items->option_2_id = $id_option_2[$key_2];
                            $products_option_2_items->price = @$request->input('price')[$key_1][$key_2][0];
                            $products_option_2_items->qty = @$request->input('stock')[$key_1][$key_2][0];
                            $products_option_2_items->name_th = $_option_detail . ' ' . $_option_detail_2;
                            $products_option_2_items->name_en = $_option_detail . ' ' . $_option_detail_2;
                            $products_option_2_items->save();

                            $products_option_2_items->barcode = $products->barcode . $products_option_2_items->id;
                            $products_option_2_items->save();

                            if (!in_array($request->input('price')[$key_1][$key_2][0], $array_max_min)) {
                                array_push($array_max_min, $request->input('price')[$key_1][$key_2][0]);
                            }
                        }
                    }
                }elseif(!empty($_option_detail)){
                    $key_2 = 0;
                    $products_option_2_items = new ProductsOption2Items();
                    $products_option_2_items->product_id = $products->id;
                    $products_option_2_items->products_item_id = $products_item->id;
                    $products_option_2_items->option_1_id = $id_option_1[$key_1];
                    $products_option_2_items->option_2_id = $id_option_2[$key_2];
                    $products_option_2_items->price = @$request->input('price')[$key_1][$key_2][0];
                    $products_option_2_items->qty = @$request->input('stock')[$key_1][$key_2][0];
                    $products_option_2_items->name_th = $_option_detail . ' ' . $_option_detail_2;
                    $products_option_2_items->name_en = $_option_detail . ' ' . $_option_detail_2;
                    $products_option_2_items->save();

                    $products_option_2_items->barcode = $products->barcode . $products_option_2_items->id;
                    $products_option_2_items->save();

                    if (!in_array($request->input('price')[$key_1][$key_2][0], $array_max_min)) {
                        array_push($array_max_min, $request->input('price')[$key_1][$key_2][0]);
                    }
                }
            }
        }

        $products->min_price = @min($array_max_min);
        $products->max_price = @max($array_max_min);
        $products->save();

        if (!empty($request->file('produc_gallery'))) {
            foreach ($request->file('produc_gallery') as $key => $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('product/' . $products->customer_id . '/' . $products->id, $imageFile, $imageName, 'public');
                $gal = new ProductsGallery();
                $gal->path = 'product/' . $products->customer_id . '/' . $products->id . '/';
                $gal->name = $imageName;
                $gal->product_id = $products->id;
                if ($key == 0) {
                    $gal->use_profile = 1;
                } else {
                    $gal->use_profile = 0;
                }
                $gal->save();
            }
        }


        DB::commit();

        return redirect('home')->withSuccess('เพิ่มสินค้าสำเร็จ');

        // if(!empty(Auth::guard('admin')->user()->name)){
        //     return redirect('admin/store-detail/' . $request->input('store_id'));
        // }else{
        //     return redirect('backend/store-detail/' . $request->input('store_id'));
        // }
    }






    public function remove_gallery(Request $request)
    {

        $gallery = DB::table('products_gallery')->where('products_gallery.id', $request->input('gallery_id'))->first();

        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }

        $filePath = 'public/' . $gallery->path . $gallery->name; // e.g., public/product/14/1/168982623844956.jpeg

        if (Storage::disk('local')->exists($filePath)) {
            // File exists, so you can delete it
            Storage::disk('local')->delete($filePath);

            // Optionally, you can also remove the gallery entry from the database
            DB::table('products_gallery')->where('products_gallery.id', $request->input('gallery_id'))->delete();

            return response()->json(['message' => 'Gallery deleted successfully']);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }


    public function product_add($id)
    {

        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกร้านค้า');
        }

        $data['category'] = DB::table('category')->get();
        $data['brands'] = DB::table('brands')->get();
        $data['store_id'] = $id;

        return view('frontend/product-add', $data);
    }





}

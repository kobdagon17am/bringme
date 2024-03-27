<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Storage;
use File;
use Hash;
use Auth;

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



class ProductsController extends Controller
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
        return view('backend/products');
    }

    public function genbarcode($product_id)
    {


        $products = DB::table('products')
            ->where('id', $product_id)
            ->first();

        $barcode = DB::table('products_option_2_items')
            ->where('product_id', $product_id)
            ->get();



        if ($products) {
            return view('backend/product-genbarcode', [
                'products' => $products,
                'barcode' => $barcode
            ]);
        } else {
            return redirect('admin/products')->withError('ไม่พบข้อมูลรายการ');
        }
    }



    public function pdf_barcode(Request $rs)
    {
        $file = new Filesystem;
        $file->cleanDirectory(public_path('pdf/'));


        $product = DB::table('products')
            ->where('id', $rs->product_id)
            ->first();


        $barcode = DB::table('products_option_2_items')
            ->where('id', $rs->item_id)
            ->first();

        $data = ['product' => $product, 'barcode' => $barcode];

        // Create a PDF instance using the PDF facade
        $pdf = PDF::loadView('backend.PDF.barcode', compact('data'));


        for ($i = 0; $i < $rs->count; $i++) {
            $pathfile = public_path('pdf/'.$rs->item_id.'_'.$i.'.pdf');
            $pdf->save($pathfile);

        }

        $this->merger_pdf($rs->item_id);
        $url =  asset('local/public/barcode/result_'.$rs->item_id.'.pdf');

         return $url;
    }

    public function merger_pdf($item_id)
    {

        $pdf = PDFMerger::init();
        $files = scandir(public_path('pdf/'));

        foreach ($files as $val) {
            if ($val != '.' && $val != '..') {
                $pdf->addPDF(public_path('pdf/' . $val), 'all');
            }
        }
        $pdf->merge();
        $fileName = public_path('barcode/result_'.$item_id.'.pdf');

        // return $pdf->stream();
        $pdf->save(($fileName));
        // $pdf->save(public_path($path_file));
        // $data_image = file_get_contents($path);
    }


    public function products_pending_tranfer()
    {
        return view('backend/products-pending-tranfer');
    }

    public function products_waitapproved()
    {
        return view('backend/products-waitapproved');
    }

    public function products_waitapproved_detail($id = '')
    {

        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกสินค้า');
        }

        $data['products_item'] = DB::table('products_item')
            ->select('products_item.*', 'products_item.id as item_id', 'customer.name as store_name', 'products_transfer.id as transfer_id', 'products.category_id', 'products.brands_id',
             'products.store_id as store_id', 'products.storage_method_id','products_transfer.shipping_type')
            ->where('products_item.id', $id)
            ->where('products_item.approve_status', 0)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_transfer', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->orderBy('products_item.created_at','desc')
            ->first();

        $data['gallery'] = DB::table('products_gallery')->where('product_id', $data['products_item']->product_id)->get();
        $data['category'] = DB::table('category')->get();
        $data['brands'] = DB::table('brands')->get();
        $data['brands_select'] = DB::table('brands')->where('id', $data['products_item']->brands_id)->first();

        $data['products_option_head'] = DB::table('products_option_head')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_1'] = DB::table('products_option_1')->where('product_id', $data['products_item']->product_id)->get();
        $data['products_option_2'] = DB::table('products_option_2')->where('product_id', $data['products_item']->product_id)->get();
        if($data['products_item']->is_preorder == 0){
            $data['products_option_2_items'] = DB::table('products_option_2_items')->where('products_item_id',$data['products_item']->id)->where('product_id', $data['products_item']->product_id)->get();
        }else{
            $data['products_option_2_items'] = DB::table('products_option_2_items')->where('products_item_pre_id',$data['products_item']->id)->where('product_id', $data['products_item']->product_id)->get();
        }

        $data['storage_method'] = DB::table('storage_method')->get();
        $data['id'] = $id;

        return view('backend/products-waitapproved-detail', $data);
    }

    public function product_add($id)
    {
        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกร้านค้า');
        }

        $data['category'] = DB::table('category')->get();
        $data['brands'] = DB::table('brands')->get();
        $data['storage_method'] = DB::table('storage_method')->get();
        $data['store_id'] = $id;

        return view('backend/product-add', $data);
    }

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
        $data['storage_method'] = DB::table('storage_method')->get();

        return view('backend/product-edit', $data);
    }

    public function product_create(Request $request)
    {

        // dd($request->input() , $request->file(), max(array(1)) );

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

        if(!empty(Auth::guard('admin')->user()->name)){
            return redirect('admin/store-detail/' . $request->input('store_id'));
        }else{
            return redirect('backend/store-detail/' . $request->input('store_id'));
        }
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

        if(!empty(Auth::guard('admin')->user()->name)){
            return redirect('admin/store-detail/' . $products_item->customer_id);
        }else{
            return redirect('backend/store-detail/' . $products_item->customer_id);
        }
    }

    public function product_panding_tranfer_detail($id = '')
    {
        if (empty($id)) {
            return redirect()->back()->withError('กรุณาเลือกสินค้า');
        }

        $data['data'] = DB::table('products_transfer')
            ->select(
                'products_item.*',
                'customer.name as stor_name',
                'products_transfer.approve_status as approve_status_transfer',
                'products_transfer.id as transfer_id',
                'products_transfer.path_img',
                'brands.name_th as brand_name',
                'products_transfer.shipping_name',
                'customer.tel',
                'products.category_id as category_id',

                'products_transfer.path_img',
                'products_transfer.img',
                'products_transfer.tracking',
                'products_transfer.shipping_type',
                'products_transfer.time_period',
            )
            ->leftJoin('products_item', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brands_id')
            ->where('products_transfer.id', '=', $id)
            ->first();



        $data['gallery'] = DB::table('products_gallery')->where('product_id', @$data['data']->product_id)->get();
        $data['category'] = DB::table('category')->get();
        $data['shelf'] = DB::table('dataset_shelf')->get();

        return view('backend/product-panding-tranfer-detail', $data);
    }


    public function product_panding_tranfer_detail_all($id = '')
    {



        $customer_id = DB::table('products_transfer')
        ->select(
            'customer.id',
            'customer.name as stor_name',
            'customer.tel',
        )
        ->leftJoin('products_item', 'products_transfer.products_item_id', '=', 'products_item.id')
        ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
        ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
        ->leftJoin('brands', 'brands.id', '=', 'products.brands_id')
        ->where('products_transfer.id', '=', $id)
        ->first();


        if (empty($customer_id)) {
            return redirect()->back()->withError('ไม่มีรายการสินค้ารอรับ');
        }

        $products_transfer = DB::table('products_transfer')
            ->select(
                'products_transfer.*',
                'customer.name as stor_name',
                'products_transfer.approve_status as approve_status_transfer',
                'products_transfer.id as transfer_id',
                'products_transfer.path_img',
                'brands.name_th as brand_name',
                'products_transfer.shipping_name',
                'customer.tel',
                'products.category_id as category_id',

                'products_transfer.path_img',
                'products_transfer.img',
                'products_transfer.tracking',
                'products_transfer.shipping_type',
                'products_transfer.time_period',
                'products_gallery.path as gal_path',
                'products_gallery.name as gal_name',
                'products_item.name_th',
                'category.name_th as c_name_th',

                'stock_lot.date_in_stock',
                'stock_lot.lot_expired_date',
                'products_item.transfer_status',
                'stock_shelf.name as shelf_name',
                'stock_floor.floor as floor_name',
                'products_item.production_date',
                'products_item.shelf_lift',
                'products_item.stock_cut_off',
            )
            ->leftJoin('products_item', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
            ->leftJoin('stock_lot', 'stock_lot.product_id', '=', 'products.id')
            ->leftJoin('stock_shelf', 'stock_shelf.product_id', '=', 'products.id')
            ->leftJoin('stock_floor', 'stock_floor.product_id', '=', 'products.id')


            ->leftJoin('brands', 'brands.id', '=', 'products.brands_id')
            ->leftJoin('products_gallery','products_gallery.product_id','products_item.product_id')
            ->leftJoin('category','category.id','products.category_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.customer_id', '=',  $customer_id->id)
            ->where('products_item.transfer_status',2)
            ->orderByDesc('products_transfer.id')
            ->get();

            $data['store_detail'] = DB::table('store')->where('customer_id', $customer_id->id)->first();

            // dd( $products_transfer);


        $data['customer'] = $customer_id;
        $data['products_transfer'] = $products_transfer;
        //$data['gallery'] = DB::table('products_gallery')->where('product_id', @$data['data']->product_id)->get();
        $data['category'] = DB::table('category')->get();
        $data['shelf'] = DB::table('dataset_shelf')->get();
        $data['page_id'] =$id;


        return view('backend/product-panding-tranfer-detail-all',$data);
    }

    public function product_panding_tranfer_pdf(Request $rs)
    {

        $products_transfer = DB::table('products_transfer')
        ->select(
            'products_transfer.*',
            'customer.name as stor_name',
            'products_transfer.approve_status as approve_status_transfer',
            'products_transfer.id as transfer_id',
            'products_transfer.path_img',
            'brands.name_th as brand_name',
            'products_transfer.shipping_name',
            'customer.tel',
            'products.category_id as category_id',

            'products_transfer.path_img',
            'products_transfer.img',
            'products_transfer.tracking',
            'products_transfer.shipping_type',
            'products_transfer.time_period',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name',
            'products_item.name_th',
            'category.name_th as c_name_th',
            'products_item.transfer_status',
        )
        ->leftJoin('products_item', 'products_transfer.products_item_id', '=', 'products_item.id')
        ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
        ->leftJoin('products', 'products.id', '=', 'products_item.product_id')
        ->leftJoin('brands', 'brands.id', '=', 'products.brands_id')
        ->leftJoin('products_gallery','products_gallery.product_id','products_item.product_id')
        ->leftJoin('category','category.id','products.category_id')
        ->where('products_gallery.use_profile',1)
        ->wherein('products_transfer.id',$rs->id)
        ->orderByDesc('products_transfer.id')
        ->get();


        // panding-tranfer.blade


        $file = new Filesystem;
        $file->cleanDirectory(public_path('products_transfer/'));


        $data = ['products_transfer' => $products_transfer];

        // Create a PDF instance using the PDF facade
        $pdf = PDF::loadView('backend.PDF.panding-tranfer', compact('data'));

        // $pdf2 = PDF::loadView('backend.PDF.order_detail', compact('data'));

        $pathfile = public_path('products_transfer/result_'.$rs->customer_id.'.pdf');

        $pdf->save($pathfile);

        $url =  asset('local/public/products_transfer/result_'.$rs->customer_id.'.pdf');
        $data = ['status'=>'success','url'=>$url];
         return $data;
    }



    public function item_confirmation(Request $rs)
    {

        if(empty($rs->transfer_id)){
            return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withError('กรุณาเลือกรายการที่ต้องการยืนยันการรับสินค้า');
        }
        // dd($rs->all());
        if($rs->type == 'confirm_all'){


            if(empty($rs->transfer_id)){
                return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withError('กรุณาเลือกรายการที่ต้องการยืนยันการรับสินค้า');
            }


            if ($rs->tranfer_status == 1) {
                foreach($rs->transfer_id as $i => $value){
                    if($rs->shelf[$value] == null || $rs->floor[$value] == null || $rs->qty[$value] == null){
                        return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withError('กรุณาเลือก shelf และ ชั้น ในการเก็บสินค้า');
                    }
                }

                foreach($rs->transfer_id as $i => $value){
                    if($rs->shelf[$value]!=null && $rs->floor[$value]!=null && $rs->qty[$value]!=null){
                        $data = \App\Http\Controllers\API2Controller::api_products_transfer_approve_back($value, $rs->date_in_stock, $rs->lot_expired_date[$value], $rs->lot_number, $rs->shelf[$value], $rs->floor[$value], $rs,$rs->qty[$value]);
                        if ($data['status'] == 0) {
                            return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withError($data['message']);
                        }
                    }
                }
                    return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withSuccess('อัพเดทรายการสำเร็จ');
            } else {

                try {
                    DB::BeginTransaction();

                    $dataPrepare = [
                        'approve_status' => $rs->tranfer_status,

                    ];
                    $products_item = DB::table('products_transfer')
                        ->wherein('id',$rs->transfer_id)
                        ->update($dataPrepare);


                    DB::commit();
                    return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withSuccess('อัพเดทรายการสำเร็จ');
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect('admin/product-panding-tranfer-detail-all/'.$rs->page_id)->withError('อัพเดทรายการไม่สำเร็จ');
                }
            }

        }else{
            if ($rs->tranfer_status == 1) {
                // dd($rs->transfer_id);

                $data = \App\Http\Controllers\API2Controller::api_products_transfer_approve_back($rs->transfer_id, $rs->date_in_stock, $rs->lot_expired_date, $rs->lot_number, $rs->shelf, $rs->floor, $rs,$rs->qty);

                if ($data['status'] == 0) {
                    return redirect('admin/products-pending-tranfer')->withError($data['message']);
                }

                if ($data['status'] == 1) {
                    return redirect('admin/products-pending-tranfer')->withSuccess('อัพเดทรายการสำเร็จ');
                }
            } else {
                try {
                    DB::BeginTransaction();

                    $dataPrepare = [
                        'approve_status' => $rs->tranfer_status,

                    ];
                    $products_item = DB::table('products_transfer')
                        ->where('id', $rs->transfer_id)
                        ->update($dataPrepare);


                    DB::commit();
                    return redirect('admin/products-pending-tranfer')->withSuccess('อัพเดทรายการสำเร็จ');
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect('admin/products-pending-tranfer')->withError('อัพเดทรายการไม่สำเร็จ');
                }
            }
        }


    }

    public function product_confirmation(Request $rs)
    {


        if ($rs->type == 'confirm') {
            try {
                DB::BeginTransaction();
                $dataPrepare = [
                    'approve_status' => 1,
                    'transfer_status' => 1,
                    // 'transfer_status' => 1,
                ];

                $products_item = DB::table('products_item')
                    ->where('id', $rs->id)
                    ->update($dataPrepare);
                DB::commit();
                return redirect('admin/products-waitapproved')->withSuccess('อนุมัติรายการสำเร็จ');
            } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/products-waitapproved')->withError('อนุมัติรายการไม่สำเร็จ');
            }
        } elseif ($rs->type == 'cancel') {
            try {
                DB::BeginTransaction();
                $dataPrepare = [
                    'approve_status' => 2,
                    'transfer_status' => 9,

                ];


                $products_item = DB::table('products_item')
                    ->where('id', $rs->id)
                    ->update($dataPrepare);
                DB::commit();
                return redirect('admin/products-waitapproved')->withSuccess('ยกเลิกรายการสำเร็จ');
            } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/products-waitapproved')->withError('ยกเลิกรายการไม่สำเร็จ');
            }
        } else {
            return redirect('admin/products-waitapproved')->withError('ยกเลิกรายการไม่สำเร็จ');
        }
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

        if(!empty(Auth::guard('admin')->user()->name)){
            return redirect('admin/product_edit/' . $request->input('item_id'));
        }else{
            return redirect('backend/product_edit/' . $request->input('item_id'));
        }

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



    public function products_waitapproved_datable(Request $request)
    {


        $products_item = DB::table('products_item')
            ->select('products_item.*', 'store.store_name as stor_name', 'products_item.id as item_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name')
            // ->where('status','=','success')
            // ->where('customer_type', 2)
            ->leftJoin('store', 'store.customer_id', '=', 'products_item.customer_id')
            ->leftJoin('products_gallery','products_gallery.product_id','products_item.product_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.approve_status', 0);
        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($products_item);
        return $sQuery


            ->addColumn('img', function ($row) {

                $profile_img =$row->gal_path.$row->gal_name;
                $img_path = asset('local/storage/app/public/'.$profile_img);
               $img = '<div class="flex">
               <div class="w-20 h-20 image-fit zoom-in">
                   <img alt="Midone - HTML Admin Template" class=" rounded-full"
                       src="'.$img_path.'">
               </div>
           </div>';
                return $img;
            })


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: ' . $row->name_th . '</div>
                <div class="font-medium whitespace-nowrap">EN: ' . $row->name_en . '</div>';

                return $name;
            })


            ->addColumn('is_preorder', function ($row) {
                if($row->is_preorder == 1){
                    $html = '<b class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">สินค้าพรีออเดอร์</font> </b>';
                }else{
                    $html = '';
                }



                return $html;
            })



            ->addColumn('stor_name', function ($row) {

                $name = $row->stor_name;

                return $name;
            })


            ->addColumn('qty', function ($row) {


                return number_format($row->qty, 2);
            })


            // ->addColumn('approve_status', function ($row) {

            //     if ($row->approve_status == 1) {
            //         $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> อนุมัติ </div>';
            //     } elseif ($row->approve_status == 2) {

            //         $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
            //     } else {
            //         $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอตรวจสอบ </div>';;
            //     }
            //     return $htmml;
            // })


            ->addColumn('transfer_status', function ($row) {

                if ($row->transfer_status == 0) {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                } elseif ($row->transfer_status == 1) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอจัดส่ง </div>';
                } elseif ($row->transfer_status == 2) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>';
                } elseif ($row->transfer_status == 3) {

                    $htmml =  '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>';
                } elseif ($row->transfer_status == 9) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })
            ->addColumn('action', function ($row) {



       $html = '<a href="'.route('admin/products-waitapproved-detail', ['id' => $row->item_id]).'" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รายละเอียด</font> </a>';

                return $html;
            })


            ->rawColumns(['product_name', 'approve_status', 'transfer_status', 'action', 'img','is_preorder'])
            ->make(true);
    }


    public function products_datable(Request $request)
    {


        $products_item = DB::table('products_item')
            ->select('products_item.*', 'customer.name as stor_name',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name')
            // ->where('status','=','success')
            // ->where('customer_type', 2)
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_gallery','products_gallery.product_id','products_item.product_id')
            ->where('products_gallery.use_profile',1)
            ->where('products_item.approve_status', '=', 1);
        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
        // ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($products_item);
        return $sQuery


            ->addColumn('img', function ($row) {

                $profile_img =$row->gal_path.$row->gal_name;
                $img_path = asset('local/storage/app/public/'.$profile_img);
                $img = '<div class="flex">
                <div class="w-20 h-20 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="'.$img_path.'">
                </div>
            </div>';

                return $img;
            })


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: ' . $row->name_th . '</div>
                <div class="font-medium whitespace-nowrap">EN: ' . $row->name_en . '</div>';

                return $name;
            })

            ->addColumn('stor_name', function ($row) {

                $name = $row->stor_name;

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

                    $htmml =  '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>';
                } elseif ($row->transfer_status == 9) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })

            ->addColumn('barcode', function ($row) {
                $html = '<div class="flex justify-center items-center">



                <a class="flex items-center mr-3 btn-sm btn btn-sm btn-outline-primary" href="' . route('admin/genbarcode', ['product_id' => $row->product_id]) . '">  BarCode </a></div>';
                return $html;
            })

            ->addColumn('action', function ($row) {

           $html = '<a href="'. route('admin/product-edit', ['id' => $row->product_id]) . '" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">แก้ไข</font> </a>';

                // <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>ลบ </a>
                return $html;
            })


            ->rawColumns(['product_name', 'approve_status', 'transfer_status', 'action', 'img', 'barcode'])
            ->make(true);
    }


    public function products_pending_tranfer_datatable(Request $request)
    {

        $products_transfer = DB::table('products_transfer')
            ->select('products_item.*', 'customer.name as stor_name', 'products_transfer.approve_status as approve_status_transfer', 'products_transfer.id as products_transfer_id',
            'products_gallery.path as gal_path',
            'products_gallery.name as gal_name')
            ->leftJoin('products_item', 'products_transfer.products_item_id', '=', 'products_item.id')
            ->leftJoin('customer', 'customer.id', '=', 'products_item.customer_id')
            ->leftJoin('products_gallery','products_gallery.product_id','products_item.product_id')
            ->where('products_gallery.use_profile',1)
            ->wherein('products_transfer.approve_status', [0, 2, 3]);

        $sQuery = Datatables::of($products_transfer);
        return $sQuery


            ->addColumn('img', function ($row) {

                $profile_img =$row->gal_path.$row->gal_name;
                $img_path = asset('local/storage/app/public/'.$profile_img);
                $img = '<div class="flex">
                <div class="w-20 h-20 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="'.$img_path.'">
                </div>
            </div>';

                return $img;
            })


            ->addColumn('product_name', function ($row) {

                $name = '<div class="font-medium whitespace-nowrap">TH: ' . $row->name_th . '</div>
                <div class="font-medium whitespace-nowrap">EN: ' . $row->name_en . '</div>';

                return $name;
            })

            ->addColumn('stor_name', function ($row) {

                $name = $row->stor_name;

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

                if ($row->approve_status_transfer == 0) {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>';
                } elseif ($row->approve_status_transfer == 1) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าครบแล้ว </div>';
                } elseif ($row->approve_status_transfer == 2) {

                    $htmml =  '<div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าบางส่วน </div>';
                } elseif ($row->approve_status_transfer == 3) {

                    $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่รับสินค้า </div>';
                } else {
                    $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>';
                }
                return $htmml;
            })

            ->addColumn('action', function ($row) {
                 $html = '<a href="'. route('admin/product-panding-tranfer-detail', ['id' => $row->products_transfer_id])  . '" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รับสินค้ารายชิ้น</font> </a>';

                return $html;
            })

            ->addColumn('action2', function ($row) {
                $html = '<a href="'. route('admin/product-panding-tranfer-detail-all', ['id' => $row->products_transfer_id])  . '" class="btn btn-sm  btn-outline-primary mr-2 mb-2"> <font style="color: black;">รับสินค้าหลายรายการ</font> </a>';

               return $html;
           })


            ->rawColumns(['product_name', 'approve_status', 'transfer_status','action2', 'action', 'img'])
            ->make(true);
    }
}

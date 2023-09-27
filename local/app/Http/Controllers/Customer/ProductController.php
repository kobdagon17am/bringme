<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
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
        dd('dd');

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

}

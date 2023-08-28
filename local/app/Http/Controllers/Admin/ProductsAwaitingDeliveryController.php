<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use File;
use Hash;
use App\Models\Store;
use App\Models\Brands;
use App\Models\Products;
Use App\Models\Customer_address;
Use App\Models\Category;
Use App\Models\CustomerCartProduct;
Use App\Models\CustomerCart;
use App\Mail\SendMail;
Use App\Models\ProductsItem;
use Illuminate\Support\Facades\Mail;
Use App\Models\ProductsOptionHead;
Use App\Models\ProductsOption1;
Use App\Models\ProductsOption2;
Use App\Models\ProductsOption2Items;
Use App\Models\ProductsTransfer;
Use App\Models\Stock;
Use App\Models\StockLot;
Use App\Models\StockShelf;
Use App\Models\StockItems;
Use App\Models\StockFloor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
Use App\Models\CustomerCartProductCutStock;
Use App\Models\CustomerCartTracking;

class ProductsAwaitingDeliveryController extends  Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('admin');
     }


    public function index(){

        $order = CustomerCart::select('customer_cart.*','dataset_pay_type.pay_type_name','shipping_type.name as shipping_type_name','shipping_type.detail as shipping_type_detail')
        ->join('dataset_pay_type','dataset_pay_type.id','customer_cart.pay_type')
        ->join('shipping_type','shipping_type.id','customer_cart.shipping_type_id')
        ->where('customer_cart.status',2)
        ->where('customer_cart.transfer_status',0)
        ->get();


        return view('backend/products-awaiting-delivery',[
            'order' => $order,
        ]);
    }


}

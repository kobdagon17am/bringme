<?php

namespace App\Http\Controllers;

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

class API2Controller extends Controller
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

    public function api_products_transfer_approve(Request $r)
    {
        DB::beginTransaction();
        try
            {
                $products_transfer = ProductsTransfer::where('id',$r->products_transfer_id)->first();
                $products_item = ProductsItem::where('id',@$products_transfer->products_item_id)->first();
                if($products_item){
                    $stock = new Stock();
                    $stock->product_id = $products_item->product_id;
                    $stock->save();
                }else{
                    return response()->json([
                        'message' =>  'ไม่พบข้อมูลสินค้า',
                        'status' => 0,
                        'data' => '',
                    ]);
                }

                DB::commit();
                return response()->json([
                    'message' => 'ทำรายการสำเร็จ',
                    'status' => 1,
                    'data' => $products_item,
                ]);

                }
                catch (\Exception $e) {
                    DB::rollback();
                // return $e->getMessage();
                return response()->json([
                    'message' =>  $e->getMessage(),
                    'status' => 0,
                    'data' => '',
                ]);
                }
                catch(\FatalThrowableError $fe)
                {
                    DB::rollback();
                    return response()->json([
                        'message' =>  $e->getMessage(),
                        'status' => 0,
                        'data' => '',
                    ]);
                }
    }


}

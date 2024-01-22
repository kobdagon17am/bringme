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
Use App\Models\Stock;
Use App\Models\StockLot;
Use App\Models\StockShelf;
Use App\Models\StockItems;
Use App\Models\ProductsGallery;
Use App\Models\FinanceMovement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
Use App\Models\CustomerCartProductCutStock;
Use App\Models\ProductsComment;
use App\Models\CustomerCartAddress;
use App\Models\CustomerAcc;
use App\Models\Withdraw;
use App\Models\MessageList;

class API4Controller extends Controller
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


     public function test_edit_stock_lot()
     {
        DB::beginTransaction();
        try
        {

            $stock_lots = StockLot::select('id','product_id')->where('products_item_id',null)->get();
            foreach($stock_lots as $sl){
                $p_items = ProductsItem::select('id')->where('product_id',$sl->product_id)->get();
                if(count($p_items)==1){
                    foreach($p_items as $pi){
                        $p_item_data = ProductsItem::where('id',$pi->id)->first();
                        $stl_data = StockLot::where('id',$sl->id)->first();
                        $stl_data->products_item_id = $p_item_data->id;
                        $stl_data->product_expired_date = date('Y-m-d', strtotime($p_item_data->production_date. ' + '.($p_item_data->shelf_lift).' days'));
                        $stl_data->save();
                    }
                }
            }


            DB::commit();

            return response()->json([
                'message' => 'success',
                'status' => 1,
                'data' => [
                    // 'setting_period_finance' => $setting_period_finance,
                ],
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
        catch(\FatalThrowableError $e)
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

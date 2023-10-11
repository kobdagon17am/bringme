<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Customer;
use App\Models\Brands;
use App\Models\Store;
use Storage;
use File;
use Hash;
use Illuminate\Support\Str;

class StoresController extends Controller
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

            if(!empty($request->file('profile_img'))){
                $profile_img = $request->file('profile_img');
                $extension = $profile_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('upload/profile/', $profile_img, $imageName, 'public');
                $customer->profile_img_path = 'upload/profile/';
                $customer->profile_img = $imageName;
                $customer->save();
            }

            $brands = Brands::where('name_th',$request->input('brand_name'))->first();
            if(!$brands){
                $brand = new Brands();
                $brand->name_th = $request->input('brand_name');
                $brand->name_en = $request->input('brand_name');
                $brand->has_store = 1;
                $brand->save();
            }else{
                $brand = $brands;
            }

            $store = Store::find($request->input('store_id'));
            $store->customer_id = $customer->id;
            $store->brands_id = $brand->id;
            $store->category_id = $request->input('category_id');
            $store->store_name = $request->input('store_name');
            $store->store_type = $request->input('store_type');
            $store->brand_product_detail = $request->input('brand_product_detail');
            $store->storage_method_id = $request->input('storage_method_id');
            $store->shelf_lift = $request->input('shelf_lift');
            $store->qty_sku = $request->input('qty_sku');
            $store->shipping_date = date('Y-m-d', strtotime($request->input('shipping_date')));
            $store->social = $request->input('social');
            $store->address = $request->input('address2');
            $store->province_id = $request->input('province_id2');
            $store->amphures_id = $request->input('amphures_id2');
            $store->district_id = $request->input('district_id2');
            $store->zipcode = $request->input('zipcode2');
            $store->bank_id = $request->input('bank_id');
            $store->bank_account_name = $request->input('bank_account_name');
            $store->bank_account_number = $request->input('bank_account_number');
            $store->save();

            if($request->file('product_ex_img') !=''){
                $product_ex_img = $request->file('product_ex_img');
                $extension = $product_ex_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $product_ex_img, $imageName, 'public');
                $store->product_ex_img_path = 'store/' . $store->id . '/';
                $store->product_ex_img = $imageName;
                $store->save();
            }

            if($request->file('product_pack_img') !=''){
                $product_pack_img = $request->file('product_pack_img');
                $extension = $product_pack_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $product_pack_img, $imageName, 'public');
                $store->product_pack_img_path = 'store/' . $store->id . '/';
                $store->product_pack_img = $imageName;
                $store->save();
            }

            if($request->file('certificate') !=''){
                $certificate = $request->file('certificate');
                $extension = $certificate->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $certificate, $imageName, 'public');
                $store->certificate_path = 'store/' . $store->id . '/';
                $store->certificate = $imageName;
                $store->save();
            }

            if($request->file('bank_img') !=''){
                $bank_img = $request->file('bank_img');
                $extension = $bank_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $bank_img, $imageName, 'public');
                $store->bank_img_path = 'store/' . $store->id . '/';
                $store->bank_img = $imageName;
                $store->save();
            }

            if($request->file('id_card_img') !=''){
                $id_card_img = $request->file('id_card_img');
                $extension = $id_card_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $id_card_img, $imageName, 'public');
                $store->id_card_img_path = 'store/' . $store->id . '/';
                $store->id_card_img = $imageName;
                $store->save();
            }

            if($request->file('company_img') !=''){
                $company_img = $request->file('company_img');
                $extension = $company_img->getClientOriginalExtension();
                $imageName = time() . rand(0, 10) . rand(0, 10000) . '.' . $extension;
                Storage::disk('public')->putFileAs('store/' . $store->id, $company_img, $imageName, 'public');
                $store->company_img_path = 'store/' . $store->id . '/';
                $store->company_img = $imageName;
                $store->save();
            }

        }else{
            return redirect('home')->withError(' Data Is Null');
        }
        return redirect('home');
    }

}


@extends('layouts.backend.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        ข้อมูลร้านค้า
    </h2>
    @if(!empty(Auth::guard('admin')->user()->name))
    <form class="grid grid-cols-12 gap-6" method="POST" action="{{ url('admin/store_create') }}" enctype="multipart/form-data">
    @else
    <form class="grid grid-cols-12 gap-6" method="POST" action="{{ url('store_create') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="col-span-12">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    ข้อมูลส่วนตัว
                </h2>
            </div>
            <!-- <div class="p-5"> -->
            <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                        <div>
                            <label for="" class="form-label">ชื่อ-นามสกุล</label>
                            <input id="firstname" type="text" class="form-control" placeholder="Input text" name="firstname" value="">
                        </div>

                        <div>
                            <label for="" class="form-label">วันเดือนปีเกิด</label>
                            <div class="relative">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> <i data-lucide="calendar" class="w-4 h-4"></i> </div> <input type="text" class="datepicker form-control pl-12 change_birthday" data-single-mode="true" id="birthday" name="birthday" value="">
                            </div>
                        </div>

                        <div>
                            <label for="" class="form-label">อายุ</label>
                            <input id="age" type="text" class="form-control" placeholder="Input text" value="">
                        </div>

                        <div>
                            <label for="" class="form-label">อีเมล</label>
                            <input id="email" type="text" class="form-control" placeholder="Input text" name="email" value="">
                        </div>

                        <div>
                            <label for="" class="form-label">รหัสผ่าน</label>
                            <input id="password" type="password" class="form-control" placeholder="Input text" name="password" value="">
                        </div>

                        <div>
                            <label for="" class="form-label">เบอร์ติดต่อ</label>
                            <input id="tel" type="text" class="form-control" placeholder="Input text" name="tel" value="">
                        </div>

                    </div>

                    <div class="flex items-center p-5">
                        <h2 class="font-medium text-base mr-auto">
                            ข้อมูลที่อยู่
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                        <div>
                            <label for="address" class="form-label">ห้อง/บ้านเลขที่</label>
                            <input id="address" type="text" class="form-control" placeholder="Input text" name="address" value="">
                        </div>

                        <div>
                            <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                            <select id="province_id" class="form-select" name="province_id">
                                <option value="">- เลือกจังหวัด -</option>
                                @if(!empty($provinces))
                                    @foreach($provinces as $_provinces)
                                        <option value="{{ $_provinces->id }}">{{ $_provinces->name_th }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                            <select id="amphures_id" class="form-select" name="amphures_id">
                                <option value="">- เลือกเขต -</option>
                                @if(!empty($amphures))
                                    @foreach($amphures as $_amphures)
                                        <option value="{{ $_amphures->id }}">{{ $_amphures->name_th }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <label for="update-profile-form-8" class="form-label">แขวง/ตำบล</label>
                            <select id="district_id" class="form-select" name="district_id">
                                <option value="">- เลือกแขวง -</option>
                                @if(!empty($districts))
                                    @foreach($districts as $_districts)
                                        <option value="{{ $_districts->id }}">{{ $_districts->name_th }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div>
                            <label for="" class="form-label">รหัสไปรษณีย์</label>
                            <input id="zipcode" type="text" class="form-control" placeholder="Input text" name="zipcode" value="">
                        </div>

                    </div>

                </div>
                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img alt="Midone - HTML Admin Template" class="profile_show tooltip rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                            <div title="Remove this profile photo?" class="remove_profile_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                        </div>
                        <div class="mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile_img" name="profile_img">
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- END: Display Information -->
            <!-- BEGIN: Personal Information -->
        </div>

        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    ข้อมูลร้านค้า
                </h2>
            </div>
            <!-- <div class="p-5"> -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                <div>
                    <label for="" class="form-label">ชื่อแบรนด์</label>
                    <input id="" type="text" class="form-control" placeholder="Input text" value="" name="store_name">
                </div>

                <div>
                    <label for="update-profile-form-8" class="form-label">ประเภทสินค้า</label>
                    <select id="update-profile-form-8" class="form-select" name="category_id">
                        <option value="">- เลือกประเภทสินค้า -</option>
                        @if(!empty($category))
                            @foreach($category as $_category)
                                <option value="{{ $_category->id }}">{{ $_category->name_th }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="" class="form-label">รายละเอียดเกี่ยวกับแบรนด์และสินค้า</label>
                    <textarea class="form-control" id="" rows="5" name="brand_product_detail">{{ (!empty($store_detail) ? nl2br($store_detail->brand_product_detail) : '') }}</textarea>
                </div>

                <div>
                    <label for="update-profile-form-8" class="form-label">วิธีการจัดเก็บสินค้า</label>
                    <select id="update-profile-form-8" class="form-select" name="storage_method_id">
                        option value="">- เลือกวิธีการจัดเก็บสินค้า -</option>
                        @if(!empty($storage_method))
                            @foreach($storage_method as $_storage_method)
                                <option value="{{ $_storage_method->id }}">{{ $_storage_method->name_th }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="" class="form-label">Shelf-life</label>
                    <input id="" type="text" class="form-control" name="shelf_lift" placeholder="Input text" value="{{ (!empty($store_detail) ? $store_detail->shelf_lift : '') }}">
                </div>

                <div>
                    <label for="" class="form-label">จำนวนรายการสินค้า (SKU)</label>
                    <input id="" type="text" class="form-control" name="qty_sku" placeholder="Input text" value="{{ (!empty($store_detail) ? $store_detail->qty_sku : '') }}">
                </div>

                <div>
                    <label for="" class="form-label">วันที่พร้อมส่ง</label>
                    <div class="relative">
                        <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </div>
                        <input type="text" class="datepicker form-control pl-12" data-single-mode="true" name="shipping_date" value="{{ (!empty($store_detail) ? $store_detail->shipping_date : '') }}">
                    </div>
                </div>

                <div>
                    <label for="" class="form-label">ช่องทาง social media</label>
                    <input id="" type="text" class="form-control" placeholder="Input text" name="social" value="{{ (!empty($store_detail) ? $store_detail->social : '') }}">
                </div>

            </div>

            <div class="flex items-center p-5">
                <h2 class="font-medium text-base mr-auto">
                    ข้อมูลที่อยู่ร้านค้า
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                <div>
                    <label for="" class="form-label">ห้อง/บ้านเลขที่</label>
                    <input id="" type="text" class="form-control" placeholder="Input text" name="address2" value="{{ (!empty($store_detail) ? $store_detail->address : '') }}">
                </div>

                <div>
                    <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                    <select id="province_id2" class="form-select" name="province_id2">
                        <option value="">- เลือกจังหวัด -</option>
                        @if(!empty($provinces))
                            @foreach($provinces as $_provinces)
                                <option value="{{ $_provinces->id }}">{{ $_provinces->name_th }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                    <select id="amphures_id2" class="form-select" name="amphures_id2">
                        <option value="">- เลือกเขต -</option>
                        @if(!empty($amphures))
                            @foreach($amphures as $_amphures)
                                <option value="{{ $_amphures->id }}">{{ $_amphures->name_th }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="update-profile-form-8" class="form-label">แขวง/ตำบล</label>
                    <select id="district_id2" class="form-select" name="district_id2">
                        <option value="">- เลือกแขวง -</option>
                        @if(!empty($districts))
                            @foreach($districts as $_districts)
                                <option value="{{ $_districts->id }}">{{ $_districts->name_th }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="" class="form-label">รหัสไปรษณีย์</label>
                    <input id="zipcode2" type="text" class="form-control" placeholder="Input text" name="zipcode2" value="">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="" class="form-label">รูปตัวอย่างรายการสินค้า</label>
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                        <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                <img class="rounded-md detail_show" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                <div title="Remove this image?" class="remove_detail_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                            <input name="product_ex_img" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 detail_img ">
                        </div>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="" class="form-label">รูปตัวอย่างสินค้าและแพ็คเกจ</label>
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                        <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                <img class="rounded-md package_show" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                <div title="Remove this image?" class=" remove_package_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                            <input  name="product_pack_img" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 package_img">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="" class="form-label">รูปใบรับรองสินค้า / Certificate อื่นๆ (ถ้ามี)</label>
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                        <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                <img class="rounded-md certificate_show " alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                <div title="Remove this image?" class="remove_certificate_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                            <input  name="certificate" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 certificate_img ">
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>

        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    ข้อมูลบัญชีธนาคาร
                </h2>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label for="update-profile-form-bank" class="form-label">ชื่อธนาคาร</label>
                        <select id="update-profile-form-bank" class="form-select" name="bank_id">
                            <option value="">- เลือกธนาคาร -</option>
                            @if(!empty($bank))
                                @foreach($bank as $_bank)
                                    <option value="{{ $_bank->id }}">{{ $_bank->txt_desc }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div>
                        <label for="" class="form-label">ชื่อบัญชี</label>
                        <input id="" type="text" class="form-control" placeholder="Input text" name="bank_account_name" value="">
                    </div>

                    <div>
                        <label for="" class="form-label">เลขบัญชี</label>
                        <input id="" type="text" class="form-control" placeholder="Input text" name="bank_account_number" value="">
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                            <div class="flex flex-wrap px-4">
                                <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                    <img class="rounded-md idcard_show " alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                    <div title="Remove this image?" class="remove_idcard_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                <input name="bank_img" type="file" class="idcard_img w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                            <div class="flex flex-wrap px-4">
                                <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                    <img class="bank_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                    <div title="Remove this image?" class="remove_bank_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                <input name="id_card_img" type="file" class="bank_img w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="" class="form-label">สำเนาหน้าหนังสือรับรองบริษัท</label>
                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                            <div class="flex flex-wrap px-4">
                                <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                    <img class="company_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                    <div title="Remove this image?" class="remove_company_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                <input name="company_img" type="file" class="company_img w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="flex justify-end mt-4 gap-5">
            @if(empty(Auth::guard('admin')->user()->name))
            <div class="g-recaptcha" data-sitekey="6LdPancoAAAAANOFuIjXKOAy2MWoDrCoyp4SFglB"></div>
            @endif
            <button type="reset" class="btn btn-outline-danger w-20 ">ย้อนกลับ</button>
            <button type="submit" class="btn btn-primary w-20">บันทึก</button>
        </div>
        <!-- END: Personal Information -->
    </div>

    </form>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#province_id').change(function(){
            var province_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_amphures') }}", 
              'dataType': 'html',
              'data': { 'province_id' : province_id },
              'success': function (data){
                    $('#amphures_id').html(data);
              }
            });
        });

        $('#amphures_id').change(function(){
            var amphures_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_districes') }}", 
              'dataType': 'html',
              'data': { 'amphures_id' : amphures_id },
              'success': function (data){
                    $('#district_id').html(data);
              }
            });
        });

        $('#district_id').change(function(){
            var district_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_zipcode') }}", 
              'dataType': 'html',
              'data': { 'district_id' : district_id },
              'success': function (data){
                    $('#zipcode').val(data);
              }
            });
        });

        $('#province_id2').change(function(){
            var province_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_amphures') }}", 
              'dataType': 'html',
              'data': { 'province_id' : province_id },
              'success': function (data){
                    $('#amphures_id2').html(data);
              }
            });
        });

        $('#amphures_id2').change(function(){
            var amphures_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_districes') }}", 
              'dataType': 'html',
              'data': { 'amphures_id' : amphures_id },
              'success': function (data){
                    $('#district_id2').html(data);
              }
            });
        });

        $('#district_id2').change(function(){
            var district_id = $(this).val();
            $.ajax({
              'type': 'get', 
              'url': "{{ url('/get_zipcode') }}", 
              'dataType': 'html',
              'data': { 'district_id' : district_id },
              'success': function (data){
                    $('#zipcode2').val(data);
              }
            });
        });

        $('.day-item').click(function(){
            console.log('Active');
            var age = null;
            var new_birthday = $('.change_birthday').val();
            console.log(new_birthday);
            if(new_birthday){
                var birthdate = new Date(new_birthday);
                var today = new Date();
                var age = today.getFullYear() - birthdate.getFullYear();
                var monthDiff = today.getMonth() - birthdate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }
            }
            console.log(age);
            $('#age').val(age);
        });

        $('.select_customer').change(function(){
            var customer_id = $(this).val();
            $.ajax({
              'type': 'post', 
              'url': "{{ url('admin/get_userdata') }}", 
              'dataType': 'JSON',
              'data': { 'customer_id' : customer_id, 
                        '_token' : "{{csrf_token()}}" 
                      },
              'success': function (data){
                    var url = "{{ asset('local/storage/app/public') }}/"+data.profile_img_path+data.profile_img;
                    $('#firstname').val(data.firstname);
                    $('#email').val(data.email);
                    $('#birthday').val(data.birthday);
                    $('#tel').val(data.tel);
                    $('#address').val(data.address);
                    $('#province_id').val(data.province_id);
                    $('#amphures_id').val(data.amphures_id);
                    $('#district_id').val(data.district_id);
                    $('#zipcode').val(data.zipcode);
                    $('.profile_show').attr('src',url);
                    var age = null;
                    if(data.birthday){
                        var birthdate = new Date(data.birthday);
                        var today = new Date();
                        var age = today.getFullYear() - birthdate.getFullYear();
                        var monthDiff = today.getMonth() - birthdate.getMonth();
                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                            age--;
                        }
                    }
                    $('#age').val(age);
              }
            });
        });

        // Get the file input element by its class
        const fileInput = $(".profile_img");

        // Add an event listener to the file input element
        fileInput.on("change", function () {
            // Check if a file is selected
            if (fileInput[0].files && fileInput[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the profile_show class
                    $(".profile_show").attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInput[0].files[0]);
            }
        });

        function changeImage(imageElement, fileInputElement) {
            if (fileInputElement[0].files && fileInputElement[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the specified image element
                    imageElement.attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInputElement[0].files[0]);
            }
        }

        function handleImageRemoval(imageElement, fileInputElement) {
            imageElement.attr("src", "");
            fileInputElement.val("");
        }

        const profileShow = $(".profile_show");
        const removeProfileShow = $(".remove_profile_show");
        const profilefileInput = $(".profile_img");

        removeProfileShow.on("click", function () {
            handleImageRemoval(profileShow, profilefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        profilefileInput.on("change", function () {
            changeImage(profileShow, profilefileInput);
        });

        const detailShow = $(".detail_show");
        const removedetailShow = $(".remove_detail_show");
        const detailfileInput = $(".detail_img");

        removedetailShow.on("click", function () {
            handleImageRemoval(detailShow, detailfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        detailfileInput.on("change", function () {
            changeImage(detailShow, detailfileInput);
        });

        const packageShow = $(".package_show");
        const removepackageShow = $(".remove_package_show");
        const packagefileInput = $(".package_img");

        removepackageShow.on("click", function () {
            handleImageRemoval(packageShow, packagefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        packagefileInput.on("change", function () {
            changeImage(packageShow, packagefileInput);
        });

        const certificateShow = $(".certificate_show");
        const removecertificateShow = $(".remove_certificate_show");
        const certificatefileInput = $(".certificate_img");

        removecertificateShow.on("click", function () {
            handleImageRemoval(certificateShow, certificatefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        certificatefileInput.on("change", function () {
            changeImage(certificateShow, certificatefileInput);
        });

        const idcardShow = $(".idcard_show");
        const removeidcardShow = $(".remove_idcard_show");
        const idcardfileInput = $(".idcard_img");

        removeidcardShow.on("click", function () {
            handleImageRemoval(idcardShow, idcardfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        idcardfileInput.on("change", function () {
            changeImage(idcardShow, idcardfileInput);
        });

        const bankShow = $(".bank_show");
        const removebankShow = $(".remove_bank_show");
        const bankfileInput = $(".bank_img");

        removebankShow.on("click", function () {
            handleImageRemoval(bankShow, bankfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        bankfileInput.on("change", function () {
            changeImage(bankShow, bankfileInput);
        });

        const companyShow = $(".company_show");
        const removecompanyShow = $(".remove_company_show");
        const companyfileInput = $(".company_img");

        removecompanyShow.on("click", function () {
            handleImageRemoval(companyShow, companyfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        companyfileInput.on("change", function () {
            changeImage(companyShow, companyfileInput);
        });

    });
</script>

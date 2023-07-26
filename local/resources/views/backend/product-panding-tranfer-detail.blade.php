@extends('layouts.backend.app')

@section('content')
    <div class="content">
        <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-11 ">
                <!-- BEGIN: Uplaod Product -->
                <div class="intro-y box p-5 mt-5 mb-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            อนุมัติรายการรอรับสินค้า
                        </div>
                        <form method="POST" action="{{ route('admin/item_confirmation') }}" id="item_confirmation">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $data->id }}">
                            <input type="hidden" name="transfer_id" value="{{ $data->transfer_id }}">

                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">วันที่รับเข้าสินค้า</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" value="{{ date('Y-m-d', strtotime($data->shipping_date)) }}"
                                            class=" form-control w-56 block mx-auto" name="date_in_stock"
                                            data-single-mode="true">
                                    </div>
                                </div>
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">วันหมดอายุ</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" value="{{ date('Y-m-d', strtotime($data->production_date)) }}"
                                            class="form-control w-56 block mx-auto" name="lot_expired_date"
                                            data-single-mode="true">
                                    </div>

                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">หมายเลข Lot | ชื่อ Lot</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control w-56 block mx-auto" name="lot_number" required
                                        value="{{ $data->barcode }}">




                                </div>


                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ที่จัดเก็บสินค้า</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-center">
                                         <select name="shelf" id="shelf"
                                            class="form-select form-select-lg sm:mt-2 sm:mr-2"
                                            aria-label=".form-select-lg example" required>
                                            <option value=""> ------ เลือก Shelf -----</option>
                                            @foreach($shelf as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                           @endforeach
                                        </select>

                                        <select name="floor" id="floor"
                                        class="form-select form-select-lg sm:mt-2 sm:mr-2"
                                        aria-label=".form-select-lg example" required disabled>
                                        <option value=""> ------ เลือกชั้น -----</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                    </div>
                                </div>




                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียด</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <textarea id="regular-form-1" type="text" class="form-control" name="note" placeholder="Note">{{ $data->detail_th }}</textarea>
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">สลิปโอนเงิน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="h-64 w-3/5 mr-6 image-fit">
                                            <?php $url_img = Storage::disk('public')->url(''); ?>
                                            <img alt="Midone - HTML Admin Template"
                                                src="{{ asset($url_img . '' . $data->path_img . '' . $data->img) }}"
                                                data-action="zoom" class="w-full rounded-md">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">สถานะการจัดส่ง</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="flex flex-col sm:flex-row">
                                            @if ($data->transfer_status == 3)
                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-6" class="form-check-input" value="3"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-daniel-craig"
                                                        @if ($data->transfer_status == 3) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-6">รับสินค้าแล้ว</label>
                                                </div>
                                            @elseif($data->transfer_status == 9)
                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-6" class="form-check-input" value="9"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-daniel-craig"
                                                        @if ($data->transfer_status == 9) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-6">ไม่อนุมัติ</label>
                                                </div>
                                            @else
                                                <div class="form-check mr-2">
                                                    <input id="radio-switch-4" class="form-check-input" value="0"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-chris-evans"
                                                        @if ($data->transfer_status == 0) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-4">รออนุมัติจัดส่ง</label>
                                                </div>
                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-5" class="form-check-input" value="1"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-liam-neeson"
                                                        @if ($data->transfer_status == 1) checked @endif>
                                                    <label class="form-check-label" for="radio-switch-5">รอจัดส่ง</label>
                                                </div>
                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-6" class="form-check-input" value="2"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-daniel-craig"
                                                        @if ($data->transfer_status == 2) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-6">รอรับสินค้า</label>
                                                </div>

                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-6" class="form-check-input" value="3"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-daniel-craig"
                                                        @if ($data->transfer_status == 3) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-6">รับสินค้าแล้ว</label>
                                                </div>

                                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                                    <input id="radio-switch-6" class="form-check-input" value="9"
                                                        type="radio" name="tranfer_status"
                                                        value="horizontal-radio-daniel-craig"
                                                        @if ($data->transfer_status == 9) checked @endif>
                                                    <label class="form-check-label"
                                                        for="radio-switch-6">ไม่อนุมัติ</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">

                                    <button type="button" data-tw-toggle="modal"
                                        data-tw-target="#confirm-confirmation-modal"
                                        class="btn py-3 btn-primary">บันทึก</button>
                                </div>

                                <div id="confirm-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="p-5 text-center">



                                                    <div class="text-3xl mt-5">Are you sure?</div>
                                                    <div class="text-slate-500 mt-2">
                                                        ยืนยันการบันทึกข้อมูล
                                                    </div>
                                                </div>
                                                <div class="px-5 pb-8 text-center">
                                                    <button type="button" data-tw-dismiss="modal"
                                                        class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                                    <button type="submit" class="btn btn-primary w-24"
                                                        form="item_confirmation" name="type"
                                                        value="confirm">Confirm</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            อัปโหลดสินค้า
                        </div>
                        <div class="mt-5">
                            <form method="POST" action="{{ route('admin/item_gallery') }}" id="item_gallery"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $data->id }}">
                                <div class="form-inline items-start flex-col xl:flex-row mt-10">
                                    <div class="form-label w-full xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รูปสินค้า</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full mt-3 xl:mt-0 flex-1 border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="grid grid-cols-10 gap-5 pl-4 pr-5 gallery_place">
                                            @if (!empty($gallery))
                                                @foreach ($gallery as $_gallery)
                                                    <div
                                                        class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                            src="{{ !empty($_gallery->name) ? asset('local/storage/app/uploads/gallery/' . $_gallery->product_id . '/' . $_gallery->name) : asset('backend/dist/images/preview-12.jpg') }}">
                                                        <div
                                                            class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                            <i data-lucide="x" class="w-4 h-4"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div
                                            class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                                            <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input id="horizontal-form-1" type="file" name="gallery_file[]"
                                                class="w-full h-full top-0 left-0 absolute opacity-0 image-input" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                    <button type="submit" class="btn py-3 btn-primary">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Uplaod Product -->
                <!-- BEGIN: Product Information -->
                <div class="intro-y box p-5 mt-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            ข้อมูลสินค้า
                        </div>
                        <div class="mt-5">
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">ชื่อแบรนด์</div>
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div>
                                        </div>
                                    </div>
                                </div>
                                <input id="brand-name" type="text" class="form-control" placeholder="Brand name">
                            </div>
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">ชื่อสินค้า</div>
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div>
                                        </div>
                                    </div>
                                </div>
                                <input id="product-name" type="text" class="form-control" placeholder="Product name">
                            </div>
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">ประเภทสินค้า</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <select id="category" data-placeholder="" class="tom-select w-full tomselected"
                                        multiple="multiple" tabindex="-1" hidden="hidden">
                                        <option value="Electronic" selected="true">Electronic</option>
                                        <option value="Photography" selected="true">Photography</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">วิธีการจัดเก็บ</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <div class="flex flex-col sm:flex-row">
                                        <div class="form-check mr-2">
                                            <input id="radio-switch-4" class="form-check-input" type="radio"
                                                name="horizontal_radio_button" value="horizontal-radio-chris-evans">
                                            <label class="form-check-label" for="radio-switch-4">Ambient</label>
                                        </div>
                                        <div class="form-check mr-2 mt-2 sm:mt-0">
                                            <input id="radio-switch-5" class="form-check-input" type="radio"
                                                name="horizontal_radio_button" value="horizontal-radio-liam-neeson">
                                            <label class="form-check-label" for="radio-switch-5">Chilled</label>
                                        </div>
                                        <div class="form-check mr-2 mt-2 sm:mt-0">
                                            <input id="radio-switch-6" class="form-check-input" type="radio"
                                                name="horizontal_radio_button" value="horizontal-radio-daniel-craig">
                                            <label class="form-check-label" for="radio-switch-6">Frozen</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                <button type="button" class="btn py-3 btn-primary">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Product Information -->
                <!-- BEGIN: Product Detail -->
                <div class="intro-y box p-5 mt-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            รายละเอียดสินค้า
                        </div>
                        <div class="mt-5">
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">รายละเอียดสินค้า</div>
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <div class="editor" style="display: none;">
                                        <p>Content of the editor.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">

                                <button type="button" class="btn py-3 btn-primary">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- END: Product Management -->
                <!-- BEGIN: Weight & Shipping -->
                <!-- <div class="intro-y box p-5 mt-5">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 mr-2">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg> Weight &amp; Shipping
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Product Weight</div>
                                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                                    </div>
                                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                        Enter the weight by weighing the product after it is <span class="font-medium text-slate-600 dark:text-slate-300">packaged</span>.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="sm:grid grid-cols-4 gap-2">
                                                    <select class="form-select">
                                                        <option value="Gram (g)">Gram (g)</option>
                                                        <option value="Kilogram (kg)">Kilogram (kg)</option>
                                                    </select>
                                                    <input type="text" id="product-weight" class="form-control mt-2 sm:mt-0" placeholder="Stock">
                                                </div>
                                                <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-triangle" data-lucide="alert-triangle" class="lucide lucide-alert-triangle w-6 h-6 mr-3">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></span>
                                                    <span class="text-slate-800 dark:text-slate-500">Pay close attention to the weight of the product so that there is no difference in data with the shipping courier. <a class="text-primary font-medium" href="">Learn More</a></span>
                                                    <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Product Size</div>
                                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                                    </div>
                                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                        Enter the product size after packing to calculate the volume weight. <a class="text-primary font-medium" href="">Learn Volume Weight</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="sm:grid grid-cols-3 gap-2">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Width">
                                                        <div class="input-group-text">cm</div>
                                                    </div>
                                                    <div class="input-group mt-2 sm:mt-0">
                                                        <input type="text" class="form-control" placeholder="Height">
                                                        <div class="input-group-text">cm</div>
                                                    </div>
                                                    <div class="input-group mt-2 sm:mt-0">
                                                        <input type="text" class="form-control" placeholder="Length">
                                                        <div class="input-group-text">cm</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Shipping Insurance</div>
                                                    </div>
                                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                        Refund product &amp; postage for the seller and buyer in case of damage / loss during shipping. <a class="text-primary font-medium" href="">Learn More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="flex flex-col sm:flex-row">
                                                    <div class="form-check mr-4">
                                                        <input id="shipping-insurance-required" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-chris-evans">
                                                        <div class="form-check-label">
                                                            <div>Required</div>
                                                            <div class="leading-relaxed text-slate-500 text-xs mt-1 w-56">
                                                                You <span class="font-medium text-slate-600 dark:text-slate-300">require</span> the buyer to activate shipping insurance
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-check mr-4 mt-2 sm:mt-0">
                                                        <input id="shipping-insurance-optional" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-liam-neeson">
                                                        <div class="form-check-label">
                                                            <div>Optional</div>
                                                            <div class="leading-relaxed text-slate-500 text-xs mt-1 w-56">
                                                                You <span class="font-medium text-slate-600 dark:text-slate-300">give the buyer the option</span> to activate shipping insurance
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">Shipping Service</div>
                                                    </div>
                                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                        Configure shipping services according to your product type.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="flex flex-col sm:flex-row">
                                                    <div class="form-check mr-4">
                                                        <input id="shipping-service-standard" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-chris-evans">
                                                        <label class="form-check-label" for="shipping-service-standard">Standard</label>
                                                    </div>
                                                    <div class="form-check mr-4 mt-2 sm:mt-0">
                                                        <input id="shipping-service-custom" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-liam-neeson">
                                                        <label class="form-check-label" for="shipping-service-custom">Custom</label>
                                                    </div>
                                                </div>
                                                <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                    The delivery service for this product will be the same as in the <a class="text-primary font-medium" href="">Shipping Settings.</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">PreOrder</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="form-check form-switch">
                                                    <input id="preorder-active" class="form-check-input" type="checkbox">
                                                    <label class="form-check-label leading-relaxed text-slate-500 text-xs" for="preorder-active">
                                                        Activate PreOrder if you need a longer shipping process. <a class="text-primary font-medium" href="">Learn more.</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                <!-- END: Weight & Shipping -->
                {{-- <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <a href="products.php" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500">ยกเลิก</a>
                <button type="button" class="btn py-3 btn-primary">บันทึก</button>
            </div> --}}
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.image-input').change(function(e) {
                var files = e.target.files;
                var galleryDiv = $('.gallery_place');

                // Remove existing preview images and divs
                galleryDiv.empty();

                // Loop through selected files
                for (var i = 0; i < files.length; i++) {
                    (function(file, index) {
                        var reader = new FileReader();

                        // Closure to capture the file information
                        reader.onload = function(e) {
                            var div = $(
                                '<div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in gallery_number_' +
                                index + '" ref="' + index + '">' +
                                '<img class="rounded-md" alt="Midone - HTML Admin Template" src="' +
                                e.target.result + '">' +
                                '<div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_gallery" ref="' +
                                index + '">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>' +
                                '</div>' +
                                '</div>');

                            // Append the div to the gallery
                            galleryDiv.append(div);
                        };

                        // Read the image file as a data URL
                        reader.readAsDataURL(file);
                    })(files[i], i);
                }
            });

            $('.remove_gallery').click(function() {
                var ref = $(this).attr('ref');
                $('.gallery_number_' + ref).remove();
            });
        });


        $('#shelf').change(function() {
            $('#floor').prop('disabled', false);

        });

        // function append_warehouse_select(data) {
        //     $('.warehouse_select').empty();
        //     $('.warehouse_select').append(`
        //         <option disabled selected value=""> เลือกคลัง </option>
        //         `);
        //     data.forEach((val, key) => {

        //         $('.warehouse_select').append(`
        //         <option value="${val.id}">${val.warehouse_name} (${val.warehouse_code})</option>
        //         `);
        //     });
        // }
    </script>
@endsection

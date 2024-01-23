@extends('layouts.backend.app')

@section('content')
    <div class="content">
        <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-11 ">
                <!-- BEGIN: Uplaod Product -->

                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            รับสินค้าหลายรายการ

                        </div>
                        <div class="mt-5">
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">ชื่อแบรนด์</div>

                                        </div>
                                    </div>
                                </div>
                                <input id="brand-name" type="text" class="form-control" placeholder="Brand name" readonly
                                    value="{{ $store_detail->store_name }}">
                            </div>

                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">เบอร์โทรศัพท์</div>
                                        </div>
                                    </div>
                                </div>

                                <input type="text" class="form-control w-56 " readonly placeholder="เบอร์โทรศัพท์"
                                    name="tel" value="{{ $customer->tel }}">


                            </div>


                        </div>

                    </div>
                </div>
                <form method="POST" action="{{ route('admin/item_confirmation') }}" id="item_confirmation">
                    @csrf
                    <input type="hidden" name="page_id" value="{{ $page_id }}">
                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="intro-y block sm:flex items-center h-10">

                                <div class="flex items-center mt-3 sm:mt-0">
                                    <button onclick="print_pdf();" class="ml-3 btn btn-primary flex items-center "> <svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="file-text"
                                            data-lucide="file-text"
                                            class="lucide lucide-file-text hidden sm:block w-4 h-4 mr-2">
                                            <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z">
                                            </path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <line x1="10" y1="9" x2="8" y2="9"></line>
                                        </svg> พิมพ์ใบรับสินค้า </button>
                                </div>
                            </div>




                            <div class="p-5" id="basic-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class=""><input id="select-free-all"
                                                            class="form-check-input free-product" type="checkbox"
                                                            value=""></th>
                                                    <th class="whitespace-nowrap">รูปสินค้า</th>
                                                    <th class="whitespace-nowrap">รายละเอียด</th>
                                                    {{-- <th class="whitespace-nowrap">ประเภทสินค้า</th> --}}
                                                    <th class="whitespace-nowrap">จัดส่ง</th>
                                                    {{-- <th class="whitespace-nowrap">Tracking</th> --}}
                                                    {{-- <th class="whitespace-nowrap">ชื่อขนส่ง</th> --}}
                                                    {{-- <th class="whitespace-nowrap">ประเภทการจัดส่ง</th> --}}
                                                    <th class="whitespace-nowrap">จำนวนสินค้า</th>
                                                    <th class="whitespace-nowrap">จำนวนสินค้ารับจริง</th>
                                                    {{-- <th class="whitespace-nowrap">วันหมดอายุสินค้า</th> --}}
                                                    <th class="whitespace-nowrap">วันตัดสต็อค</th>
                                                    <th class="whitespace-nowrap">ที่จัดเก็บสินค้า</th>

                                                    <th class="whitespace-nowrap">หลักฐานการจัดส่ง</th>

                                                    {{-- <th class="text-center whitespace-nowrap">สถานะ</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($products_transfer as $value)
                                                    <tr class="intro-x">


                                                        <td class="w-40">
                                                            {{-- @if ($value->shipping_type == 1)
                                                    <p>รับสินค้า</p>
                                                   @elseif($value->shipping_type == 2)
                                                    <p>ขนส่งด้วยตนเอง</p>
                                                   @else
                                                   @endif --}}

                                                            @if ($value->transfer_status == 0)
                                                                <div class="flex text-warring"> <i
                                                                        data-lucide="check-square" class="w-4 h-4 mr-2"></i>
                                                                    รออนุมัติจัดส่ง </div>
                                                            @elseif ($value->transfer_status == 1)
                                                                <div class="flex text-primary"> <i
                                                                        data-lucide="check-square" class="w-4 h-4 mr-2"></i>
                                                                    รอจัดส่ง </div>
                                                            @elseif ($value->transfer_status == 2)
                                                                <input id="checkbox-switch-1"
                                                                    class="form-check-input free-product"
                                                                    name="transfer_id[]" type="checkbox"
                                                                    value="{{ $value->id }}">
                                                            @elseif($value->transfer_status == 3)
                                                                <div class="flex text-success"> <i
                                                                        data-lucide="check-square" class="w-4 h-4 mr-2"></i>
                                                                    รับสินค้าแล้ว </div>
                                                            @elseif($value->transfer_status == 9)
                                                                <div class="flex text-danger"> <i
                                                                        data-lucide="check-square"
                                                                        class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>
                                                            @else
                                                                <div class="flex text-warning"> <i
                                                                        data-lucide="check-square"
                                                                        class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <?php
                                                            $profile_img = $value->gal_path . $value->gal_name;
                                                            $img_path = asset('local/storage/app/public/' . $profile_img);
                                                            ?>
                                                            <div class="flex">
                                                                <div class="w-20 h-20 image-fit zoom-in">
                                                                    <img alt="Midone - HTML Admin Template "
                                                                        class=" rounded-full" src="{{ $img_path }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="font-medium whitespace-nowrap">ชื่อ :
                                                                {{ $value->name_th }}
                                                            </p>
                                                            <p class="font-medium whitespace-nowrap">
                                                                หมวดหมู่ : {{ $value->c_name_th }}</p>
                                                        </td>
                                                        {{-- <td>
                                                            <p class="font-medium whitespace-nowrap">
                                                                {{ $value->c_name_th }}
                                                            </p>
                                                        </td> --}}
                                                        <td>
                                                            <p class="font-medium whitespace-nowrap">
                                                                วันที่จัดส่ง : {{ $value->shipping_date }}</p>
                                                            @if ($value->shipping_type == 1)
                                                                <p>ประเภทจัดส่ง : ใช้ขนส่ง</p>
                                                            @elseif($value->shipping_type == 2)
                                                                <p>ประเภทจัดส่ง : ขนส่งด้วยตนเอง</p>
                                                            @else
                                                            @endif
                                                            <p class="font-medium whitespace-nowrap">Tracking :
                                                                {{ $value->tracking }}
                                                            </p>
                                                            <p class="font-medium whitespace-nowrap">
                                                                ขนส่ง : {{ $value->shipping_name }}</p>
                                                        </td>
                                                        {{-- <td>
                                                            <p class="font-medium whitespace-nowrap">{{ $value->tracking }}
                                                            </p>
                                                        </td> --}}
                                                        {{-- <td>
                                                            <p class="font-medium whitespace-nowrap">
                                                                {{ $value->shipping_name }}</p>
                                                        </td> --}}
                                                        {{-- <td>
                                                            @if ($value->shipping_type == 1)
                                                                <p>ใช้ขนส่ง</p>
                                                            @elseif($value->shipping_type == 2)
                                                                <p>ขนส่งด้วยตนเอง</p>
                                                            @else
                                                            @endif
                                                        </td> --}}
                                                        <td>
                                                            <p class="font-medium whitespace-nowrap">{{ $value->qty }}
                                                            </p>
                                                        </td>

                                                        <td>

                                                            @if ($value->transfer_status == 2)
                                                                <input type="text" class="form-control block mx-auto"
                                                                    name="qty[{{ $value->id }}]"
                                                                    value="{{ $value->qty }}">
                                                            @else
                                                                <input type="text" class="form-control block mx-auto"
                                                                    name="qty[{{ $value->id }}]"
                                                                    value="{{ $value->qty }}" disabled>
                                                            @endif
                                                        </td>
                                                        {{-- <td>

                                                            @if ($value->transfer_status == 2)
                                                                <input type="date" value="{{ date('Y-m-d', strtotime($value->production_date. ' + '.($value->shelf_lift).' days')) }}"
                                                                    class=" form-control block mx-auto"
                                                                    name="product_expired_date[]" data-single-mode="true">
                                                            @else
                                                                <input type="date" value="{{ date('Y-m-d', strtotime($value->production_date. ' + '.($value->shelf_lift).' days')) }}"
                                                                    class=" form-control block mx-auto"
                                                                    name="product_expired_date[]" data-single-mode="true"
                                                                    disabled>
                                                            @endif
                                                        </td> --}}

                                                        <td>
                                                            @if ($value->transfer_status == 2)
                                                                <input type="date" value="{{ date('Y-m-d', strtotime($value->production_date. ' + '.($value->shelf_lift-$value->stock_cut_off).' days')) }}"
                                                                    class=" form-control block mx-auto"
                                                                    name="lot_expired_date[{{ $value->id }}]" data-single-mode="true">
                                                            @else
                                                                <input type="date"
                                                                    value="{{ $value->lot_expired_date }}"
                                                                    class=" form-control block mx-auto"
                                                                    name="lot_expired_date[{{ $value->id }}]" data-single-mode="true"
                                                                    disabled>
                                                            @endif

                                                        </td>



                                                        <td>
                                                            @if ($value->transfer_status == 2)
                                                                <select name="shelf[{{ $value->id }}]"
                                                                    class="form-select form-select-lg sm:mt-2 sm:mr-2 w-56"
                                                                    aria-label=".form-select-lg example" >
                                                                    <option value=""> ------ เลือก Shelf -----
                                                                    </option>
                                                                    @foreach ($shelf as $shelf_value)
                                                                        <option value="{{ $shelf_value->id }}">
                                                                            {{ $shelf_value->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                                <select name="floor[{{ $value->id }}]"
                                                                    class="form-select form-select-lg sm:mt-2 sm:mr-2  w-56"
                                                                    aria-label=".form-select-lg example" >
                                                                    <option value=""> - เลือกชั้น -</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                </select>
                                                            @else
                                                                Shelf: {{ $value->shelf_name }} <br>
                                                                floor: {{ $value->floor_name }}
                                                            @endif

                                                        </td>

                                                        <td>

                                                            @if ($value->img)
                                                                <?php $url_img = Storage::disk('public')->url(''); ?>
                                                                <img alt="Midone - HTML Admin Template"
                                                                    src="{{ asset($url_img . '' . $value->path_img . '' . $value->img) }}"
                                                                    data-action="zoom" class="w-20 rounded-md ">
                                                            @else
                                                                <p>ไม่พบเอกสารการจัดส่ง</p>
                                                            @endif
                                                        </td>






                                                    </tr>
                                                @endforeach



                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>



                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">



                            </div>
                            <!-- END: Data List -->

                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5 mb-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div
                                class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                อนุมัติรายการรอรับสินค้า
                            </div>


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
                                        <input type="date" value="{{ date('Y-m-d') }}"
                                            class=" form-control w-56 block mx-auto" name="date_in_stock"
                                            data-single-mode="true">
                                    </div>
                                </div>


                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Lot number</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="lot_number"
                                        required value="{{ date('Ymd') }}">
                                </div>


                                {{-- <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ค่าจัดส่งเพิ่มเติม (กรณีที่สินค้าชิ้นใหญ่)</div>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="shipping_price"
                                        value="">
                                </div> --}}

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

                                            <div class="form-check mr-2">
                                                <input id="radio-switch-4" class="form-check-input" value="1"
                                                    type="radio" name="tranfer_status"
                                                    value="horizontal-radio-chris-evans" checked>
                                                <label class="form-check-label" for="radio-switch-4">รับสินค้า</label>
                                            </div>
                                            {{-- <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="radio-switch-5" class="form-check-input" value="2"
                                                    type="radio" name="tranfer_status"
                                                    value="horizontal-radio-liam-neeson"
                                                    @if ($data->approve_status_transfer == 2) checked @endif>
                                                <label class="form-check-label" for="radio-switch-5">รับสินค้าบางส่วน</label>
                                            </div> --}}

                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="radio-switch-5" class="form-check-input" value="3"
                                                    type="radio" name="tranfer_status"
                                                    value="horizontal-radio-liam-neeson">
                                                <label class="form-check-label" for="radio-switch-5">ไม่อนุมัติ</label>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">หมายเหตุ</div>
                                                {{-- <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="shipping_remark"
                                        value="">
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
                                                        value="confirm_all">Confirm</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>




            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $('#shelf').change(function() {
            $('#floor').prop('disabled', false);

        });
    </script> --}}
    <script>
        // Get the "Check All" checkbox and all the product checkboxes
        const checkAllCheckbox = document.getElementById('select-free-all');
        const productCheckboxes = document.querySelectorAll('.free-product');

        // Add an event listener to the "Check All" checkbox
        checkAllCheckbox.addEventListener('change', function() {
            // Get the checked state of the "Check All" checkbox
            const isChecked = checkAllCheckbox.checked;

            // Set the checked state of all product checkboxes to match the "Check All" checkbox
            productCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });

        // Add event listeners to each product checkbox to update the "Check All" checkbox
        productCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Check if all product checkboxes are checked
                const allProductCheckboxesChecked = Array.from(productCheckboxes).every(function(
                    productCheckbox) {
                    return productCheckbox.checked;
                });

                // Update the "Check All" checkbox based on the state of all product checkboxes
                checkAllCheckbox.checked = allProductCheckboxesChecked;
            });
        });


        function print_pdf() {
            const checkedCheckboxes = document.querySelectorAll('.free-product:checked');

            if (checkedCheckboxes.length > 0) {
                // ทำบางสิ่งเมื่อมีการติกเช็คอย่างน้อยหนึ่งรายการ

                const checkedValues = [];
                $('.free-product:checked').each(function() {
                    checkedValues.push($(this).val());
                });

                Swal.fire({
                        title: 'รอสักครู่...',
                        html: 'ระบบกำลังเตรียมไฟล์ PDF...',
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    }),

                    $.ajax({
                        url: "{{ route('admin/product_panding_tranfer_pdf') }}",
                        type: 'get',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': checkedValues,
                            'customer_id': {{ $customer->id }},

                        },
                        success: function(data) {
                            Swal.close();
                            const path = data['url'];
                            window.open(path, "_blank");


                        }
                    });

                console.log(checkedValues);
            } else {

                Swal.fire({
                    icon: "error",
                    text: "คุณต้องติกเช็คอย่างน้อยหนึ่งรายการก่อนดำเนินการต่อ",

                });

            }

        }



        // function check_confirm() {
        //     const checkedCheckboxes = document.querySelectorAll('.free-product:checked');

        //     if (checkedCheckboxes.length > 0) {

        //     } else {

        //         Swal.fire({
        //             icon: "error",
        //             text: "คุณต้องติกเช็คอย่างน้อยหนึ่งรายการก่อนดำเนินการต่อ",

        //         });

        //     }

        // }
    </script>
@endsection

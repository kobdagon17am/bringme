
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
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div>
                                        </div>
                                    </div>
                                </div>
                                <input id="brand-name" type="text" class="form-control" placeholder="Brand name" readonly value="{{$store_detail->store_name}}">
                            </div>

                        </div>

                    </div>
                </div>

            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">

                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <!-- BEGIN: Data List -->
                        <button class="btn btn-primary mt-5"> พิมพ์ใบรับสินค้า </button>

                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                            <table class="table table-striped -mt-2">
                                <thead>

                                    <tr>
                                        <th class=""><input id="select-free-all" class="form-check-input free-product" type="checkbox" value=""></th>
                                        <th class="whitespace-nowrap">รูปสินค้า</th>
                                        <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                        <th class="whitespace-nowrap">ประเภทสินค้า</th>
                                        <th class="whitespace-nowrap">วันที่จัดส่งสินค้า</th>
                                        <th class="whitespace-nowrap">Tracking</th>
                                        <th class="whitespace-nowrap">ชื่อขนส่ง</th>
                                        <th class="whitespace-nowrap">ประเภทการจัดส่ง</th>
                                        <th class="whitespace-nowrap">จำนวนสินค้า</th>
                                        <th class="whitespace-nowrap">หลักฐานการจัดส่ง</th>

                                        <th class="text-center whitespace-nowrap">สถานะ</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    @foreach($products_transfer as $value)
                                    <?php //dd($value); ?>
                                    <tr class="intro-x">
                                        <td class="w-20">
                                            @if ($value->transfer_status == 2)
                                            <input id="checkbox-switch-1" class="form-check-input free-product" type="checkbox" value="{{$value->id}}">
                                            @endif
                                          </td>
                                        <td >
                                            <?php

                                            $profile_img =$value->gal_path.$value->gal_name;
                                            $img_path = asset('local/storage/app/public/'.$profile_img);
                                            ?>
                                            <div class="flex">
                                                <div class="w-20 h-20 image-fit zoom-in">
                                                    <img alt="Midone - HTML Admin Template " class=" rounded-full" src="{{$img_path}}">
                                                </div>
                                            </div>



                                        </td>
                                        <td>
                                            <p class="font-medium whitespace-nowrap">{{$value->name_th}}</p>
                                        </td>
                                        <td>
                                            <p class="font-medium whitespace-nowrap">{{$value->c_name_th}}</p>


                                        </td>
                                        <td>
                                            <p class="font-medium whitespace-nowrap">{{$value->shipping_date}}</p>

                                        </td>

                                        <td>
                                            <p class="font-medium whitespace-nowrap">{{$value->tracking}}</p>


                                        </td>


                                        <td>
                                            <p class="font-medium whitespace-nowrap">{{$value->shipping_name}}</p>
                                        </td>

                                        <td>
                                            @if($value->shipping_type == 1 )
                                             <p>ใช้ขนส่ง</p>
                                            @elseif($value->shipping_type == 2)
                                             <p>ขนส่งด้วยตนเอง</p>
                                            @else
                                            @endif

                                        </td>


                                        <td >
                                            <p class="font-medium whitespace-nowrap">{{$value->qty}}</p>
                                        </td>

                                        <td>

                                            @if($value->img)
                                            <?php  $url_img = Storage::disk('public')->url(''); ?>
                                            <img alt="Midone - HTML Admin Template"
                                            src="{{ asset($url_img . '' . $value->path_img . '' . $value->img) }}"
                                            data-action="zoom" class="w-20 rounded-md ">
                                            @else
                                            <p>ไม่พบเอกสารการจัดส่ง</p>
                                            @endif
                                        </td>

                                        <td class="w-40">
                                            {{-- @if($value->shipping_type == 1 )
                                            <p>รับสินค้า</p>
                                           @elseif($value->shipping_type == 2)
                                            <p>ขนส่งด้วยตนเอง</p>
                                           @else
                                           @endif --}}

                                           @if ($value->transfer_status == 0)
                                           <div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>
                                           @elseif ($value->transfer_status == 1)
                                             <div class="flex text-primary"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอจัดส่ง </div>
                                           @elseif ($value->transfer_status == 2)

                                            <div class="flex items-center justify-center text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รอรับสินค้า </div>

                                           @elseif($value->transfer_status == 3)

                                            <div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รับสินค้าแล้ว </div>
                                            @elseif($value->transfer_status == 9)

                                            <div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> ไม่อนุมัติ </div>
                                            @else
                                            <div class="flex text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติจัดส่ง </div>
                                            @endif

                                        </td>





                                    </tr>
                                    @endforeach



                                </tbody>
                            </table>


                        </div>
                        <!-- END: Data List -->
                    </div>
                </div>
            </div>



            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>


        $('#shelf').change(function() {
            $('#floor').prop('disabled', false);

        });


    </script>
    <script>
        // Get the "Check All" checkbox and all the product checkboxes
        const checkAllCheckbox = document.getElementById('select-free-all');
        const productCheckboxes = document.querySelectorAll('.free-product');

        // Add an event listener to the "Check All" checkbox
        checkAllCheckbox.addEventListener('change', function () {
          // Get the checked state of the "Check All" checkbox
          const isChecked = checkAllCheckbox.checked;

          // Set the checked state of all product checkboxes to match the "Check All" checkbox
          productCheckboxes.forEach(function (checkbox) {
            checkbox.checked = isChecked;
          });
        });

        // Add event listeners to each product checkbox to update the "Check All" checkbox
        productCheckboxes.forEach(function (checkbox) {
          checkbox.addEventListener('change', function () {
            // Check if all product checkboxes are checked
            const allProductCheckboxesChecked = Array.from(productCheckboxes).every(function (productCheckbox) {
              return productCheckbox.checked;
            });

            // Update the "Check All" checkbox based on the state of all product checkboxes
            checkAllCheckbox.checked = allProductCheckboxesChecked;
          });
        });
      </script>
@endsection

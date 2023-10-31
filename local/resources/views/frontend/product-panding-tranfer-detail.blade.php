@extends('layouts.frontend.app')

@section('content')
    <div class="content">
        <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-11 ">
                <!-- BEGIN: Uplaod Product -->


                <div class="intro-y box p-5">
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
                                            <div class="font-medium">ชื่อแบรนด์</div>
                                            <div
                                                class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                Required</div>
                                        </div>
                                    </div>
                                </div>
                                <input id="brand-name" type="text" class="form-control" placeholder="Brand name" readonly value="{{$data->brand_name}}">
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
                                <input id="product-name" type="text" class="form-control" readonly value="{{$data->name_th}}" placeholder="Product name">
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
                                    <select id="category" data-placeholder="" class="tom-select w-full tomselected" name="category_id" tabindex="-1" hidden="hidden">
                                        @if(!empty($category))
                                            @foreach($category as $_category)
                                                <option {{ (!empty($data) ? ($_category->id == $data->category_id ? 'selected' : '') : '') }} value="{{ $_category->id }}">{{ $_category->name_th }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
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
                                            <?php $url_img = Storage::disk('public')->url(''); ?>

                                            @if (!empty($gallery))
                                                @foreach ($gallery as $_gallery)
                                                    <div
                                                        class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                        <img class="rounded-md" data-action="zoom" alt="Midone - HTML Admin Template"
                                                            src="{{ !empty($_gallery->name) ? asset($url_img .''. $_gallery->path . '' . $_gallery->name) : asset('backend/dist/images/preview-12.jpg') }}">
                                                        <div
                                                            class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white right-0 top-0 -mr-2 -mt-2">
                                                            <i data-lucide="x" class="w-4 h-4"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        {{-- <div
                                            class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                                            <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input id="horizontal-form-1" type="file" name="gallery_file[]"
                                                class="w-full h-full top-0 left-0 absolute opacity-0 image-input" multiple>
                                        </div> --}}
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

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
                                     {!!$data->detail_th!!}
                                </div>
                            </div>

                            {{-- <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">

                                <button type="button" class="btn py-3 btn-primary">บันทึก</button>
                            </div> --}}
                        </div>
                    </div>
                </div>


                <div class="intro-y box p-5 mt-5 mb-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            อนุมัติรายการรอรับสินค้า
                        </div>
                        <form action="{{ route('item_sand_tranfer') }}" method="POST" id="item_confirmation" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="item_id" value="{{ $data->id }}">

                            <div class="mt-5">

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">เลข Tracking</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="tracking" required
                                        value="">
                                </div>

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
                                                <div class="font-medium">วันหมดอายุ</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $currentDate = date('Y-m-d'); // วันปัจจุบันในรูปแบบ 'Y-m-d'
                                        $daysToAdd = 30;
                                        $newDate = date('Y-m-d', strtotime($currentDate . ' + ' . $daysToAdd . ' days'));
                                     ?>
                                        <input type="date" value="{{$newDate}}""
                                            class="form-control w-56 block mx-auto" name="lot_expired_date"
                                            data-single-mode="true">
                                    </div>

                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ชื่อขนส่ง</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="shipping_name" required value="">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">เบอร์โทรศัพท์</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56" readonly placeholder="เบอร์โทรศัพท์" name="tel" value="{{$data->tel}}">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">จำนวนสินค้า</div>
                                                <div
                                                    class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                    Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control w-56 block mx-auto" name="qty" required
                                        value="{{$data->qty}}">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row pt-5 first:mt-0 first:pt-0">
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
                                    <input type="text" class="form-control w-56 block mx-auto" name="shipping_remark" value="">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 mb-0 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">หลักฐานการจัดส่ง</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="h-64 w-3/5 mr-6 image-fit">
                                              <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4" id="image-container">
                                                  <!-- Images will be added here dynamically -->
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                  <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                                                  <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 product" name="file_data[]" required multiple>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                                    <button type="submit" class="btn py-3 btn-primary">บันทึกจัดส่ง</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>


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


<script type="text/javascript">
    $(document).ready(function() {
        $('.product').change(function(e) {
          const files = e.target.files;
          const imageContainer = $('#image-container');

          // Clear the existing images
          imageContainer.empty();

          for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
              // Create a new image element for each uploaded file
              const imgElement = $('<div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">')
                .append($('<img class="rounded-md product_place" alt="Midone - HTML Admin Template">').attr('src', e.target.result))
                .append($('<div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_product">').html('<i data-lucide="x">x</i>'));

              // Append the new image element to the container
              imageContainer.append(imgElement);
            };

            reader.readAsDataURL(file);
          }
        });

        // Handle remove image click
        $('#image-container').on('click', '.remove_product', function() {
          $(this).parent().remove();
        });



    });
</script>
@endsection


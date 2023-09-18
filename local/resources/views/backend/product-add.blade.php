@extends('layouts.backend.app')

@section('content')
<form method="POST" action="{{ url('admin/product_create') }}" enctype="multipart/form-data">
@csrf()
<div class="content">
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-11 ">
            <!-- BEGIN: Uplaod Product -->
            <div class="intro-y box p-5">
              <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                  อัปโหลดสินค้า
                </div>
                <div class="mt-5">
                  <div class="col-span-1 md:col-span-12">
                    <label for="" class="form-label">รูปสินค้า</label>
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                      <div class="flex flex-wrap px-4" id="image-container">
                        <!-- Images will be added here dynamically -->
                      </div>
                      <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 product" name="produc_gallery[]" multiple>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- END: Uplaod Product -->
            <!-- BEGIN: Product Information -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        ข้อมูลสินค้า
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ชื่อแบรนด์</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="brands_id" type="text" class="w-full" name="brands_id" placeholder="Select Brand" list="brand_list" required>
                            <datalist id="brand_list">
                                <option value="" selected="true">- เลือกแบรนด์ -</option>
                                @if(!empty($brands))
                                    @foreach($brands as $_brands)
                                        <option {{ (!empty($product_detail) ? ($_brands->id == $product_detail->brands_id ? 'selected' : '') : '') }} value="{{ $_brands->name_th }}">{{ $_brands->name_th }}</option>
                                    @endforeach
                                @endif
                            </datalist>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ชื่อสินค้า (ไทย)</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="name_th" placeholder="Product name th">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ชื่อสินค้า (Eng)</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="name_en" placeholder="Product name en">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ประเภทสินค้า</div>
                                    </div>
                                </div>
                            </div>
                            <select id="category" data-placeholder="" class="tom-select w-full tomselected" name="category_id" multiple="multiple" tabindex="-1" hidden="hidden">
                                @if(!empty($category))
                                    @foreach($category as $_category)
                                        <option {{ (!empty($product_detail) ? ($_category->id == $product_detail->category_id ? 'selected' : '') : '') }} value="{{ $_category->id }}">{{ $_category->name_th }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">วิธีการจัดเก็บ</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <div class="form-check mr-2">
                                    <input name="storage_method_id" id="radio-switch-4" class="form-check-input" type="radio" name="storage_method_id" value="0">
                                    <label class="form-check-label" for="radio-switch-4">Ambient</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input name="storage_method_id" id="radio-switch-5" class="form-check-input" type="radio" name="storage_method_id" value="1">
                                    <label class="form-check-label" for="radio-switch-5">Chilled</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input name="storage_method_id" id="radio-switch-6" class="form-check-input" type="radio" name="storage_method_id" value="2">
                                    <label class="form-check-label" for="radio-switch-6">Frozen</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product Information -->
            <!-- BEGIN: Product Detail -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        รายละเอียดสินค้า
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">รายละเอียดสินค้า (TH)</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="editor" style="display: none;" name="detail_th">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="form-inline items-start flex-col xl:flex-row pt-5 first:mt-0 first:pt-0">
                        <div class="form-label xl:w-64 xl:!mr-10">
                            <div class="text-left">
                                <div class="flex items-center">
                                    <div class="font-medium">รายละเอียดสินค้า (EN)</div>
                                    <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mt-3 xl:mt-0 flex-1">
                            <div class="editor" style="display: none;" name="detail_en">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        ตัวเลือกสินค้า (รายละเอียด)
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-2 pt-2 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ตัวเลือก 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md">
                                    <div>
                                        <div class="form-inline mt-5 first:mt-0">
                                            <label class="form-label sm:w-20">หัวข้อ</label>
                                            <div class="flex items-center flex-1 xl:pr-20">
                                                <div class="input-group flex-1">
                                                    <input type="text" class="form-control" placeholder="" name="option_title[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-5 items-start first:mt-0 option_detail">
                                            <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                            <div class="flex-1">
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="" name="option_detail[]">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <p class="ml-3 xl:ml-5 remove_option_detail">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="xl:ml-20 xl:pl-5 xl:pr-20 mt-5 first:mt-0">
                                            <button type="button" class="btn btn-outline-primary border-dashed w-full add_option_detail_1">
                                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i> เพิ่มตัวเลือกใหม่
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-2 pt-2 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ตัวเลือก 2</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="relative pl-5 pr-5 xl:pr-10 py-10 bg-slate-50 dark:bg-transparent dark:border rounded-md">
                                    <div>
                                        <div class="form-inline mt-5 first:mt-0">
                                            <label class="form-label sm:w-20">หัวข้อ</label>
                                            <div class="flex items-center flex-1 xl:pr-20">
                                                <div class="input-group flex-1">
                                                    <input type="text" class="form-control" placeholder="" name="option_title[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-5 items-start first:mt-0 option_detail_2">
                                            <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                            <div class="flex-1">
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="" name="option_detail_2[]">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <p class="ml-3 xl:ml-5 remove_option_detail_2">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="xl:ml-20 xl:pl-5 xl:pr-20 mt-5 first:mt-0">
                                            <button type="button" class="btn btn-outline-primary border-dashed w-full add_option_detail_2">
                                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i> เพิ่มตัวเลือกใหม่
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">รายการตัวเลือก</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="overflow-x-auto">
                                    <table id="optionTable" class="table border">
                                        <thead>
                                            
                                        </thead>
                                        <tbody>
                                            <!-- Table content will be generated here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        การจัดการสินค้า
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">สถานะสินค้า</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="form-check form-switch">
                                    <input id="product-status-active" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="product-status-active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <a href="products.php" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500">ยกเลิก</a>
                <button type="button" class="btn py-3 btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</div>

</form>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        // Ensure that images are displayed when the page loads
        $(document).ready(function() {
          const productImages = $('.product');
          if (productImages.length > 0 && productImages[0].files.length > 0) {
            // Trigger the change event to display existing images
            productImages.change();
          }
        });

        let optionCounter = 1;
        let optionCounter_2 = 1;

        // Function to add a new option_detail div for option 1
        function addOptionDetail_1() {
            optionCounter++;
            const optionDetailClone = $('.option_detail:first').clone(true);
            optionDetailClone.find('input').attr('name', 'option_detail[]');
            optionDetailClone.find('.add_option_detail_1').removeClass('add_option_detail_1').addClass('remove_option_detail').html('<i data-lucide="trash-2" class="w-4 h-4"></i> ลบตัวเลือก');
            optionDetailClone.find('.remove_option_detail').on('click', removeOptionDetail(optionCounter));
            $('.option_detail:last').after(optionDetailClone);
            $('.option_detail:last').attr('ref', optionCounter);
            $('.remove_option_detail:last').attr('ref', optionCounter);
        }

        // Function to add a new option_detail div for option 2
        function addOptionDetail_2() {
            optionCounter_2++;
            const optionDetailClone_2 = $('.option_detail_2:first').clone(true);
            optionDetailClone_2.find('input').attr('name', 'option_detail_2[]');
            optionDetailClone_2.find('.add_option_detail_2').removeClass('add_option_detail_2').addClass('remove_option_detail_2').html('<i data-lucide="trash-2" class="w-4 h-4"></i> ลบตัวเลือก');
            optionDetailClone_2.find('.remove_option_detail_2').on('click', removeOptionDetail_2(optionCounter_2));
            $('.option_detail_2:last').after(optionDetailClone_2);
            $('.option_detail_2:last').attr('ref', optionCounter_2);
            $('.remove_option_detail_2:last').attr('ref', optionCounter_2);
        }

        // Function to remove the last option_detail div for option 1
        function removeOptionDetail(optionCounter) {
            $('.option_detail').each(function () {
                if ($(this).attr('ref') != null) {
                    if ($(this).attr('ref') == optionCounter) {
                        $(this).remove();
                    }
                }
            });
        }

        // Function to remove the last option_detail div for option 2
        function removeOptionDetail_2(optionCounter_2) {
            $('.option_detail_2').each(function () {
                if ($(this).attr('ref') != null) {
                    if ($(this).attr('ref') == optionCounter_2) {
                        $(this).remove();
                    }
                }
            });
        }

        // Attach click event to add_option_detail_1 button
        $('.add_option_detail_1').on('click', addOptionDetail_1);

        // Attach click event to add_option_detail_2 button
        $('.add_option_detail_2').on('click', addOptionDetail_2);

        // Attach click event to remove_option_detail button (for existing options 1)
        $('.remove_option_detail').click(function () {
            removeOptionDetail($(this).attr('ref'));
        });

        // Attach click event to remove_option_detail_2 button (for existing options 2)
        $('.remove_option_detail_2').click(function () {
            removeOptionDetail_2($(this).attr('ref'));
        });

        $('.option_detail').change(function(){
            generateTable();
        });

        function generateTable() {
            const optionTitles = $('input[name="option_title[]"]');
            const optionDetails = $('input[name="option_detail[]"]');
            const optionDetails_2 = $('input[name="option_detail_2[]"]');
            
            $('#optionTable tbody').empty();

            optionTitles.each(function (index) {
                const color = $(this).val();
                const option = [];

                optionDetails_2.each(function () {
                    option.push($(this).val());
                });

                row_title.append($('<td class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap"></td>'));
                row_title.append($('<td class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap"></td>'));
                row_title.append($('<td class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">ราคา</td>'));
                row_title.append($('<td class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">จำนวน</td>'));

                $('#optionTable thead').append(row_title);
                
                const rowCount = Math.max(option.length);

                for (let i = 0; i < rowCount; i++) {
                    const row = $('<tr>');

                    if (i === 0) {
                        row.append($('<td rowspan="' + rowCount + '" class="border-r">' + color + '</td>'));
                    }

                    if (option[i]) {
                        row.append($('<td>' + option[i] + '</td>'));
                    } else {
                        row.append($('<td></td>'));
                    }

                    row.append($('<td class="!px-2"><div class="input-group"><div class="input-group-text">฿</div><input type="text" class="form-control min-w-[6rem]" placeholder="ราคา"></div></td>'));

                    row.append($('<td class="!px-2"><input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค"></td>'));

                    $('#optionTable tbody').append(row);
                }
            });
        }
    });
</script>
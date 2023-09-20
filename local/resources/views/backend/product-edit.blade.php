@extends('layouts.backend.app')

@section('content')
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
                        <form method="POST" action="{{ route('admin/item_gallery') }}" id="item_gallery" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$products_item->item_id}}">
                            <div class="form-inline items-start flex-col xl:flex-row mt-10">
                                <div class="form-label w-full xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">รูปสินค้า</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1 border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="grid grid-cols-10 gap-5 pl-4 pr-5 gallery_place">
                                        @if(!empty($gallery))
                                            @foreach($gallery as $_gallery)
                                                <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ (!empty($_gallery->name) ? asset('local/storage/app/public').'/'.$_gallery->path.$_gallery->name : asset('backend/dist/images/preview-12.jpg') ) }}">
                                                    <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                        <i data-lucide="x" class="w-4 h-4" onclick="remove_gallery('{{ $_gallery->id }}')"></i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                                        <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input id="horizontal-form-1" type="file" name="gallery_file[]" class="w-full h-full top-0 left-0 absolute opacity-0 image-input" multiple>
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
    <form method="POST" action="{{ url('admin/product_update') }}" enctype="multipart/form-data">
        <input type="hidden" name="store_id" value="{{ $products_item->store_id }}">
        <input type="hidden" name="item_id" value="{{ $products_item->item_id }}">
        @csrf()
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
                            <input id="brand-name" type="text" class="w-full" name="brands_id" placeholder="Brand name" list="brand_list" value="{{ (!empty($brands_select) ? $brands_select->name_th : '') }}">
                            <datalist id="brand_list">
                                <option value="" selected="true">- เลือกแบรนด์ -</option>
                                @if(!empty($brands))
                                    @foreach($brands as $_brands)
                                        <option {{ (!empty($products_item) ? ($_brands->id == $products_item->brands_id ? 'selected' : '') : '') }} value="{{ $_brands->name_th }}">{{ $_brands->name_th }}</option>
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
                            <input id="product-name" type="text" class="w-full" name="name_th" placeholder="Product name th" value="{{ (!empty($products_item) ? $products_item->name_th : '') }}">
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
                            <input id="product-name" type="text" class="w-full" name="name_en" placeholder="Product name en" value="{{ (!empty($products_item) ? $products_item->name_en : '') }}">
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
                                        <option {{ (!empty($products_item) ? ($_category->id == $products_item->category_id ? 'selected' : '') : '') }} value="{{ $_category->id }}">{{ $_category->name_th }}</option>
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
                                    <input name="storage_method_id" id="radio-switch-4" class="form-check-input" type="radio" name="storage_method_id" value="0" {{ (!empty($products_item) ? ($products_item->storage_method_id == '0' ? 'checked' : '') : '') }} >
                                    <label class="form-check-label" for="radio-switch-4">Ambient</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input name="storage_method_id" id="radio-switch-5" class="form-check-input" type="radio" name="storage_method_id" value="1" {{ (!empty($products_item) ? ($products_item->storage_method_id == '1' ? 'checked' : '') : '') }} >
                                    <label class="form-check-label" for="radio-switch-5">Chilled</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input name="storage_method_id" id="radio-switch-6" class="form-check-input" type="radio" name="storage_method_id" value="2" {{ (!empty($products_item) ? ($products_item->storage_method_id == '2' ? 'checked' : '') : '') }} >
                                    <label class="form-check-label" for="radio-switch-6">Frozen</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">จำนวนวันที่เก็บได้ (วัน)</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="shelf_lift" placeholder="" required value="{{ (!empty($products_item) ? $products_item->shelf_lift : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ราคาโดยเฉลี่ย</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="product_price" placeholder="" required value="{{ (!empty($products_item) ? $products_item->price : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">จำนวนที่จัดส่งทั้งหมด</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="product_qty" placeholder="" required value="{{ (!empty($products_item) ? $products_item->qty : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">จำนวนวันก่อนตัด (วัน)</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="w-full" name="stock_cut_off" placeholder="" required value="{{ (!empty($products_item) ? $products_item->stock_cut_off : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">วันที่ผลิต</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="date" class="w-full" name="production_date" placeholder="" required value="{{ (!empty($products_item) ? $products_item->production_date : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">วันที่จัดส่ง</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="date" class="w-full" name="shipping_date" placeholder="" required value="{{ (!empty($products_item) ? $products_item->shipping_date : '') }}">
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
                                <textarea class="editor" style="display: none;" name="detail_th">
                                    {{ (!empty($products_item) ? $products_item->detail_th : '') }}
                                </textarea>
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
                            <textarea class="editor" style="display: none;" name="detail_en">
                                {{ (!empty($products_item) ? $products_item->detail_en : '') }}
                            </textarea>
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
                                                    <input type="text" class="form-control generate_table" placeholder="" name="option_title[{{ (!empty($products_option_head) ? $products_option_head[0]->id : '' ) }}]" value="{{ (!empty($products_option_head) ? $products_option_head[0]->name_th : '' ) }}">
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($products_option_1))
                                            @foreach($products_option_1 as $_products_option_1)
                                                <div class="form-inline mt-5 items-start first:mt-0 option_detail" ref="000{{ $_products_option_1->id }}">
                                                    <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                                    <div class="flex-1">
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control generate_table" placeholder="" name="option_detail[]" value="{{ $_products_option_1->name_th }}">
                                                            </div>
                                                            <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                                <p class="ml-3 xl:ml-5 remove_option_detail" ref="000{{ $_products_option_1->id }}">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                                                    <input type="text" class="form-control generate_table" placeholder="" name="option_title[{{ (!empty($products_option_head) ? $products_option_head[1]->id : '' ) }}]" value="{{ (!empty($products_option_head) ? $products_option_head[1]->name_th : '' ) }}">
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($products_option_2))
                                            @foreach($products_option_2 as $_products_option_2)
                                                <div class="form-inline mt-5 items-start first:mt-0 option_detail_2" ref="000{{ $_products_option_2->id }}">
                                                    <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                                    <div class="flex-1">
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control generate_table" placeholder="" name="option_detail_2[]" value="{{ $_products_option_2->name_th }}">
                                                            </div>
                                                            <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                                <p class="ml-3 xl:ml-5 remove_option_detail_2" ref="000{{ $_products_option_2->id }}">
                                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                                            @if(!empty($products_option_2_items))
                                                @foreach($products_option_2_items as $_products_option_2_items)
                                                    <?php $name_show = explode(' ', $_products_option_2_items->name_th); ?>
                                                    <tr>
                                                        <td>{{ array_shift($name_show) }}</td>
                                                        <td>{{ end($name_show) }}</td>
                                                        <td class="!px-2"><div class="input-group"><div class="input-group-text">฿</div><input type="text" class="form-control min-w-[6rem]" placeholder="ราคา" name="price[{{ array_shift($name_show) }}][{{ end($name_show) }}][]" value="{{ $_products_option_2_items->price }}"></div></td>
                                                        <td class="!px-2"><input type="text" class="form-control min-w-[6rem]" name="stock[{{ array_shift($name_show) }}][{{ end($name_show) }}][]" placeholder="สต็อค" value="{{ $_products_option_2_items->qty }}"></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                <a href="products.php" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500">ยกเลิก</a>
                <button type="submit" class="btn py-3 btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</div>

</form>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

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

        $('.generate_table').change(function(){
            generateTable();
        });

        function generateTable() {
            const optionTitles = $('input[name="option_title[]"]');
            const optionDetails = $('input[name="option_detail[]"]');
            const optionDetails_2 = $('input[name="option_detail_2[]"]');
            
            $('#optionTable tbody').empty();

            optionDetails.each(function (index) {
                const option_1 = [];
                const option_2 = [];

                optionDetails.each(function () {
                    option_1.push($(this).val());
                });

                optionDetails_2.each(function () {
                    option_2.push($(this).val());
                });
                
                const rowCount = Math.max(option_2.length);

                for (let i = 0; i < rowCount; i++) {
                    const row = $('<tr>');

                    if (i == 0) {
                        row.append($('<td rowspan="' + rowCount + '" class="border-r">' + $(this).val() + '</td>'));
                    }

                    if (option_2[i]) {
                        row.append($('<td>' + option_2[i] + '</td>'));
                    } else {
                        row.append($('<td></td>'));
                    }

                    row.append($('<td class="!px-2"><div class="input-group"><div class="input-group-text">฿</div><input type="text" class="form-control min-w-[6rem]" placeholder="ราคา" name="price['+$(this).val()+']['+option_2[i]+'][]"></div></td>'));

                    row.append($('<td class="!px-2"><input type="text" class="form-control min-w-[6rem]" name="stock['+$(this).val()+']['+option_2[i]+'][]" placeholder="สต็อค"></td>'));

                    $('#optionTable tbody').append(row);
                }
            });
        }
    });

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
                        var div = $('<div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in gallery_number_'+index+'" ref="'+index+'">'
                                    +'<img class="rounded-md" alt="Midone - HTML Admin Template" src="'+e.target.result+'">'
                                    +'<div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_gallery" ref="'+index+'">'
                                        +'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>'
                                    +'</div>'
                                    +'</div>');

                        // Append the div to the gallery
                        galleryDiv.append(div);
                    };

                    // Read the image file as a data URL
                    reader.readAsDataURL(file);
                })(files[i], i);
            }
        });

        $('.remove_gallery').click(function(){
            var ref = $(this).attr('ref');
            $('.gallery_number_'+ref).remove();
        });
    });

    function remove_gallery(gallery_id){
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
              'type': 'post', 
              'url': "{{ url('admin/remove_gallery') }}", 
              'dataType': 'text',
              'data': { 'gallery_id' : gallery_id, 
                        '_token' : "{{csrf_token()}}" 
                      },
              'success': function (data){
                    Swal.fire(
                      'ลบภาพสำเร็จ !',
                      'ภาพดังกล่าวได้ถูกลบเรียบร้อยแล้ว.',
                      'success'
                    );
                    window.location.reload();
              }
            });

          }
        })
    }
</script>
@extends('layouts.backend.app')

@section('content')
<div class="content">
    <div class="grid grid-cols-11 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-11 ">

            <div class="intro-y box p-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        อัปโหลดสินค้า
                    </div>
                    <div class="mt-5">
                        <form method="POST" action="{{ route('admin/item_gallery') }}" id="item_gallery" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$products_item->id}}">
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
                            <input id="brand-name" type="text" class="form-control" placeholder="Brand name" value="{{ (!empty($products_item) ? $products_item->store_name : '') }}">
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ชื่อสินค้า</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <input id="product-name" type="text" class="form-control" placeholder="Product name" value="{{ (!empty($products_item) ? $products_item->name_th : '') }}">
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

                                <select id="category" data-placeholder="" class="tom-select w-full tomselected" multiple="multiple" tabindex="-1" hidden="hidden">
                                    <option value="">- เลือกประเภทสินค้า -</option>
                                    @if(!empty($category))
                                        @foreach($category as $_category)
                                            <option {{ (!empty($products_item) ? ($_category->id == $products_item->category_id ? 'selected' : '') : '') }} value="{{ $_category->id }}">{{ $_category->name_th }}</option>
                                        @endforeach
                                    @endif
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
                                        <input id="radio-switch-4" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-chris-evans">
                                        <label class="form-check-label" for="radio-switch-4">Ambient</label>
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                        <input id="radio-switch-5" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-liam-neeson">
                                        <label class="form-check-label" for="radio-switch-5">Chilled</label>
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                        <input id="radio-switch-6" class="form-check-input" type="radio" name="horizontal_radio_button" value="horizontal-radio-daniel-craig">
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
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        รายละเอียดสินค้า
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">รายละเอียดสินค้า</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
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
            <!-- END: Product Detail -->
            <!-- BEGIN: Product Variant -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        ตัวเลือกสินค้า
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label sm:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ตัวเลือกสินค้า</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1 xl:text-right">
                                <button class="btn btn-primary w-44">
                                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> เพิ่มตัวเลือก
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product Variant -->
            <!-- BEGIN: Product Variant (Details) -->
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
                                    <a href="" class="text-slate-500 absolute top-0 right-0 mr-4 mt-4">
                                        <i data-lucide="x" class="w-5 h-5"></i>
                                    </a>
                                    <div>
                                        <div class="form-inline mt-5 first:mt-0">
                                            <label class="form-label sm:w-20">ชื่อ</label>
                                            <div class="flex items-center flex-1 xl:pr-20">
                                                <div class="input-group flex-1">
                                                    <input type="text" class="form-control" placeholder="Color">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-5 items-start first:mt-0">
                                            <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                            <div class="flex-1">
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="Black">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="White">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="Gray">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="xl:ml-20 xl:pl-5 xl:pr-20 mt-5 first:mt-0">
                                            <button class="btn btn-outline-primary border-dashed w-full">
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
                                    <a href="" class="text-slate-500 absolute top-0 right-0 mr-4 mt-4">
                                        <i data-lucide="x" class="w-5 h-5"></i>
                                    </a>
                                    <div>
                                        <div class="form-inline mt-5 first:mt-0">
                                            <label class="form-label sm:w-20">ชื่อ</label>
                                            <div class="flex items-center flex-1 xl:pr-20">
                                                <div class="input-group flex-1">
                                                    <input type="text" class="form-control" placeholder="Size">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline mt-5 items-start first:mt-0">
                                            <label class="form-label mt-2 sm:w-20">ตัวเลือก</label>
                                            <div class="flex-1">
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="Small">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="Medium">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="xl:flex items-center mt-5 first:mt-0">
                                                    <div class="input-group flex-1">
                                                        <input type="text" class="form-control" placeholder="Large">
                                                    </div>
                                                    <div class="w-20 flex text-slate-500 mt-3 xl:mt-0">
                                                        <a href="" class="xl:ml-5">
                                                            <i data-lucide="move" class="w-4 h-4"></i>
                                                        </a>
                                                        <a href="" class="ml-3 xl:ml-5">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="xl:ml-20 xl:pl-5 xl:pr-20 mt-5 first:mt-0">
                                            <button class="btn btn-outline-primary border-dashed w-full">
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
                                    <table class="table border">
                                        <thead>
                                            <tr>
                                                <th class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">สี</th>
                                                <th class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                                                    <div class="flex items-center">ไซส์</div>
                                                </th>
                                                <th class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">ราคา</th>
                                                <th class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">
                                                    <div class="flex items-center">
                                                        <div class="
                                                            relative w-4 h-4 mr-2 -mt-0.5
                                                            before:content-[''] before:absolute before:w-4 before:h-4 before:bg-primary/20 before:rounded-full lg:before:animate-ping
                                                            after:content-[''] after:absolute after:w-4 after:h-4 after:bg-primary after:rounded-full after:border-4 after:border-white/60 after:dark:border-darkmode-300
                                                        "></div>
                                                        สต็อค
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="3" class="border-r">ดำ</td>
                                                <td>S</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>M</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>L</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            <tr>
                                                <td rowspan="3" class="border-r">ดำ</td>
                                                <td>S</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>M</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>L</td>
                                                <td class="!px-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">฿</div>
                                                        <input type="text" class="form-control min-w-[6rem]" placeholder="ราคา">
                                                    </div>
                                                </td>
                                                <td class="!px-2">
                                                    <input type="text" class="form-control min-w-[6rem]" placeholder="สต็อค">
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Product Variant (Details) -->
            <!-- BEGIN: Product Management -->
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
            <div class="intro-y box mt-5 p-5">
                <div class="text-base sm:text-lg font-medium">2 ความคิดเห็น</div>

                <div class="intro-y mt-5 pb-10">
                    <div class="pt-5">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="http://rubick-laravel.left4code.com/dist/images/profile-2.jpg">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="flex items-center">
                                    <a href="" class="font-medium">Nicolas Cage</a>
                                    <a href="" class="ml-auto text-sm text-slate-500">ลบความคิดเห็น</a>
                                </div>
                                <div class="text-slate-500 text-xs sm:text-sm">47 seconds ago</div>
                                <div class="mt-2">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="http://rubick-laravel.left4code.com/dist/images/profile-8.jpg">
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="flex items-center">
                                    <a href="" class="font-medium">Keira Knightley</a>
                                    <a href="" class="ml-auto text-sm text-slate-500">ลบความคิดเห็น</a>
                                </div>
                                <div class="text-slate-500 text-xs sm:text-sm">58 seconds ago</div>
                                <div class="mt-2">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

@endsection

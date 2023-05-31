<!DOCTYPE html>
<html lang="th" class="light">
<!-- BEGIN: Head -->

<head>
    <?php include 'dist/include/head.php' ?>
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">
    <!-- BEGIN: Mobile Menu -->
    <?php include 'dist/include/component/MobileMenu.php' ?>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <?php include 'dist/include/component/Topbar.php' ?>
    <!-- END: Top Bar -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <?php include 'dist/include/component/SideNav.php' ?>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
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
                                        <div class="grid grid-cols-10 gap-5 pl-4 pr-5">
                                            <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="http://rubick-laravel.left4code.com/dist/images/preview-12.jpg">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                            <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="http://rubick-laravel.left4code.com/dist/images/preview-13.jpg">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                            <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="http://rubick-laravel.left4code.com/dist/images/preview-4.jpg">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                            <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="http://rubick-laravel.left4code.com/dist/images/preview-15.jpg">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                            <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="http://rubick-laravel.left4code.com/dist/images/preview-6.jpg">
                                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                                            <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input id="horizontal-form-1" type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
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
                                    <input id="brand-name" type="text" class="form-control" placeholder="Brand name">
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
                                        <select id="category" data-placeholder="" class="tom-select w-full tomselected" multiple="multiple" tabindex="-1" hidden="hidden">
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
                            </div>
                        </div>
                    </div>
                    <!-- END: Product Detail -->
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
                                                        </div>
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control" placeholder="White">
                                                            </div>
                                                        </div>
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control" placeholder="Gray">
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                        </div>
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control" placeholder="Medium">
                                                            </div>
                                                        </div>
                                                        <div class="xl:flex items-center mt-5 first:mt-0">
                                                            <div class="input-group flex-1">
                                                                <input type="text" class="form-control" placeholder="Large">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Variant Information</div>
                                            </div>
                                            <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                Apply price and stock on all variants or based on certain variant codes.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="sm:grid grid-cols-4 gap-2">
                                            <div class="input-group">
                                                <div class="input-group-text">$</div>
                                                <input type="text" class="form-control" placeholder="Price">
                                            </div>
                                            <input type="text" class="form-control mt-2 sm:mt-0" placeholder="Stock">
                                            <input type="text" class="form-control mt-2 sm:mt-0" placeholder="Variant Code">
                                            <button class="btn btn-primary mt-2 sm:mt-0">
                                                Apply To All
                                            </button>
                                        </div>
                                    </div>
                                </div> -->
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
                                <!-- <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">Wholesale</div>
                                            </div>
                                            <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                                Add wholesale price for certain quantity purchases.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="overflow-x-auto">
                                            <table class="table border">
                                                <thead>
                                                    <tr>
                                                        <th class="!pr-2 bg-slate-50 dark:bg-darkmode-800"></th>
                                                        <th class="bg-slate-50 dark:bg-darkmode-800"></th>
                                                        <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">Min.</th>
                                                        <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">Max.</th>
                                                        <th class="!px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">Unit Price</th>
                                                        <th class="!px-2 bg-slate-50 dark:bg-darkmode-800"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="!pr-2">1.</td>
                                                        <td class="whitespace-nowrap">Wholesale Price 1</td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Min Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Max Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <div class="input-group">
                                                                <div class="input-group-text">$</div>
                                                                <input type="text" class="form-control min-w-[6rem]" placeholder="Price">
                                                            </div>
                                                        </td>
                                                        <td class="!pl-4 text-slate-500">
                                                            <a href="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="!pr-2">2.</td>
                                                        <td class="whitespace-nowrap">Wholesale Price 2</td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Min Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Max Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <div class="input-group">
                                                                <div class="input-group-text">$</div>
                                                                <input type="text" class="form-control min-w-[6rem]" placeholder="Price">
                                                            </div>
                                                        </td>
                                                        <td class="!pl-4 text-slate-500">
                                                            <a href="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="!pr-2">3.</td>
                                                        <td class="whitespace-nowrap">Wholesale Price 3</td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Min Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <input type="text" class="form-control min-w-[6rem]" placeholder="Max Qty">
                                                        </td>
                                                        <td class="!px-2">
                                                            <div class="input-group">
                                                                <div class="input-group-text">$</div>
                                                                <input type="text" class="form-control min-w-[6rem]" placeholder="Price">
                                                            </div>
                                                        </td>
                                                        <td class="!pl-4 text-slate-500">
                                                            <a href="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-outline-primary border-dashed w-full mt-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="plus" data-lucide="plus" class="lucide lucide-plus w-4 h-4 mr-2">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg> Add New Wholesale Price
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                            <a href="#" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500">ปฏิเสธ</a>
                            <button type="button" class="btn py-3 btn-primary">อนุมัติ</button>
                        </div>
                    </div>
                    <!-- END: Product Variant (Details) -->

                </div>
                <!-- <div class="intro-y col-span-2 hidden 2xl:block">
                    <div class="pt-10 sticky top-0">
                        <ul class="text-slate-500 relative before:content-[''] before:w-[2px] before:bg-slate-200 before:dark:bg-darkmode-600 before:h-full before:absolute before:left-0 before:z-[-1]">
                            <li class="mb-4 border-l-2 pl-5 border-primary dark:border-primary text-primary font-medium">
                                <a href="">Upload Product</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Product Information</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Product Detail</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Product Variant</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Product Variant (Details)</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Product Management</a>
                            </li>
                            <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent">
                                <a href="">Weight &amp; Shipping</a>
                            </li>
                        </ul>
                        <div class="mt-10 bg-warning/20 dark:bg-darkmode-600 border border-warning dark:border-0 rounded-md relative p-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="lightbulb" data-lucide="lightbulb" class="lucide lucide-lightbulb w-12 h-12 text-warning/80 absolute top-0 right-0 mt-5 mr-3">
                                <line x1="9" y1="18" x2="15" y2="18"></line>
                                <line x1="10" y1="22" x2="14" y2="22"></line>
                                <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0018 8 6 6 0 006 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 018.91 14"></path>
                            </svg>
                            <h2 class="text-lg font-medium">Tips</h2>
                            <div class="mt-5 font-medium">Price</div>
                            <div class="leading-relaxed text-xs mt-2 text-slate-600 dark:text-slate-500">
                                <div>The image format is .jpg .jpeg .png and a minimum size of 300 x 300 pixels (For optimal images use a minimum size of 700 x 700 pixels).</div>
                                <div class="mt-2">Select product photos or drag and drop up to 5 photos at once here. Include min. 3 attractive photos to make the product more attractive to buyers.</div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- END: Content -->
    </div>

</body>

</html>
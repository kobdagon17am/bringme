@extends('layouts.Customer.app')

@section('content')
<div class="content">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12">
                    <!-- BEGIN: Form Layout -->
                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ข้อมูลโปรโมชันของแถม
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ชื่อโปรโมชัน</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="" type="text" class="form-control" placeholder="ชื่อโปรโมชัน" value="ขนมกล้วยคลีนซื้อ 1 ชิ้น แถม 1">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ตั้งค่าส่วนโปรโมชัน
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ประเภทโปรโมชัน</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row">
                                        <div class="form-check mr-2">
                                            <input id="discount-secondary" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-chris-evans" checked>
                                            <label class="form-check-label" for="discount-secondary">ส่วนลดสินค้ารอง</label>
                                        </div>
                                        <div class="form-check mr-2 mt-2 sm:mt-0">
                                            <input id="free-product" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-liam-neeson">
                                            <label class="form-check-label" for="free-product">สินค้าฟรี</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0 hidden" id="discount-secondary-box">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ข้อจำกัดการซื้อสินค้ารอง</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0 hidden" id="free-product-box">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ยอดการสั่งซื้อ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mr-5">
                                        <input type="text" class="form-control">
                                        <div id="" class="input-group-text">฿</div>
                                    </div>

                                    <div class="font-medium self-center mr-3">เพื่อรับ</div>

                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                        <div id="" class="input-group-text"><span class="icon-discount">ชิ้น</span></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                เลือกสินค้าหลัก
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <!-- BEGIN: Data List -->
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-striped -mt-2">
                                        <thead>
                                            <tr>
                                                <th class=""><input id="select-original-all" class="form-check-input original-product" type="checkbox" value=""></th>
                                                <th class="whitespace-nowrap">รูป</th>
                                                <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                                <th class="text-center whitespace-nowrap">จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input original-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class=" rounded-full" src="dist/images/preview-9.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                                </td>
                                                <td class="text-center">50</td>
                                            </tr>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input original-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-10.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Nike Air Max 270</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Sport &amp; Outdoor</div>
                                                </td>
                                                <td class="text-center">118</td>
                                            </tr>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input original-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-5.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Nikon Z6</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Photography</div>
                                                </td>
                                                <td class="text-center">50</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button class="btn btn-primary mt-5 w-full">ดูเพิ่มเติม</button>
                                </div>
                                <!-- END: Data List -->
                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                เลือกสินค้าฟรี
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <!-- BEGIN: Data List -->
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-striped -mt-2">
                                        <thead>
                                            <tr>
                                                <th class=""><input id="select-free-all" class="form-check-input free-product" type="checkbox" value=""></th>
                                                <th class="whitespace-nowrap">รูป</th>
                                                <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                                <th class="text-center whitespace-nowrap">จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input free-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class=" rounded-full" src="dist/images/preview-9.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                                </td>
                                                <td class="text-center">50</td>
                                            </tr>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input free-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-10.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Nike Air Max 270</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Sport &amp; Outdoor</div>
                                                </td>
                                                <td class="text-center">118</td>
                                            </tr>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input free-product" type="checkbox" value=""></td>
                                                <td class="w-40">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-5.jpg">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">Nikon Z6</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Photography</div>
                                                </td>
                                                <td class="text-center">50</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button class="btn btn-primary mt-5 w-full">ดูเพิ่มเติม</button>
                                </div>
                                <!-- END: Data List -->
                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ระยะเวลาโปรโมชัน
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ระยะเวลาโปรโมชัน</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" data-daterange="true" class="datepicker form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                รายละเอียดโปรโมชัน
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียดโปรโมชัน</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="editor" style="display: none;">
                                            <p>โปรโมชั่นเมื่อขนมกล้วยคลีนเพื่อสุขภาพซื้อ 1 ชิ้น แถม 1 เลือกสินค้าใดก็ได้ที่ร่วมรายการ</p>
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
                    <!-- END: Form Layout -->
                </div>
            </div>
        </div>
        <script>
    const selectOriginalAllEl = document.querySelector('#select-original-all')
    const selectOriginalEl = document.querySelectorAll('.original-product')

    const selectFreeAllEl = document.querySelector('#select-free-all')
    const selectFreeEl = document.querySelectorAll('.free-product')

    selectOriginalAllEl.addEventListener('change', () => {
        selectOriginalAllEl.checked === true ? selectOriginalEl.forEach(item => item.checked = true) : selectOriginalEl.forEach(item => item.checked = false)
    })

    selectFreeAllEl.addEventListener('change', () => {
        selectFreeAllEl.checked === true ? selectFreeEl.forEach(item => item.checked = true) : selectFreeEl.forEach(item => item.checked = false)
    })

    const discountType = document.querySelectorAll('input[name=discount-type]')

    const disSeconBox = document.querySelector('#discount-secondary-box')
    const freeProBox = document.querySelector('#free-product-box')

    console.log(disSeconBox.classList);
    console.log(freeProBox);

    const switchBox = () => {

        discountType.forEach(item => {

            console.log(item.getAttribute('id'));

            let chkEl = item.checked === true

            item.getAttribute('id') === 'discount-secondary' && chkEl ? disSeconBox.classList.remove('hidden') : disSeconBox.classList.add('hidden')
            item.getAttribute('id') === 'free-product' && chkEl ? freeProBox.classList.remove('hidden') : freeProBox.classList.add('hidden')

        })
    }

    switchBox()

    discountType.forEach(item => {
        item.addEventListener('change', switchBox)
    })
</script>
@endsection
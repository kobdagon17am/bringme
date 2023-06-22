@extends('layouts.Admin.app')

@section('content')
<div class="content">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12">
                    <!-- BEGIN: Form Layout -->
                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ข้อมูลโค้ดส่วนลด
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ชื่อโค้ดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="" type="text" class="form-control mt-3 xl:mt-0" placeholder="ชื่อแคมเปญ" value="Coupon126">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">โค้ดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="" type="text" class="form-control mt-3 xl:mt-0" placeholder="ชื่อแคมเปญ" value="Coupon126">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ประเภทโค้ดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="form-check mr-2">
                                                <input id="discount-store" class="form-check-input" type="radio" name="discount-code-type" value="">
                                                <label class="form-check-label" for="discount-store">โค้ดส่วนลดร้านค้า</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="discount-product" class="form-check-input" type="radio" name="discount-code-type" value="">
                                                <label class="form-check-label" for="discount-product">โค้ดส่วนลดสินค้า</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5 hidden" id="select-product">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                สินค้าที่ต้องการเข้าร่วม
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <!-- BEGIN: Data List -->
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-striped -mt-2">
                                        <thead>
                                            <tr>
                                                <th class=""><input id="selectall" class="form-check-input select-product" type="checkbox" value=""></th>
                                                <th class="whitespace-nowrap">รูป</th>
                                                <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                                <th class="text-center whitespace-nowrap">จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="intro-x">
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input select-product" type="checkbox" value=""></td>
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
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input select-product" type="checkbox" value=""></td>
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
                                                <td class="w-20"><input id="checkbox-switch-1" class="form-check-input select-product" type="checkbox" value=""></td>
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
                                ตั้งค่าส่วนลด
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ประเภทส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row mt-3 xl:mt-0">
                                        <div class="form-check mr-2">
                                            <input id="discount-value" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-chris-evans" checked>
                                            <label class="form-check-label" for="discount-value">มูลค่าส่วนลด</label>
                                        </div>
                                        <div class="form-check mr-2 mt-2 sm:mt-0">
                                            <input id="discount-percent" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-liam-neeson">
                                            <label class="form-check-label" for="discount-percent">ส่วนลด %</label>
                                        </div>
                                        <div class="form-check mr-2 mt-2 sm:mt-0">
                                            <input id="discount-point" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-daniel-craig">
                                            <label class="form-check-label" for="discount-point">ส่วนลดคะแนน</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mt-3 xl:mt-0">
                                        <div id="" class="input-group-text"><span class="icon-discount"></span></div>
                                        <input type="text" class="form-control disable-input">
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ขั้นต่ำ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mt-3 xl:mt-0">
                                        <div id="" class="input-group-text"><span class="icon-discount"></span></div>
                                        <input type="text" class="form-control disable-input">
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">จำนวนที่ใช้ได้</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mt-3 xl:mt-0">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">จำนวนโค้ดสูงสุดต่อ 1 ผู้ซื้อ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mt-3 xl:mt-0">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ระยะเวลาแคมเปญ
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ระยะเวลาแคมเปญ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" data-daterange="true" class="datepicker form-control mt-3 xl:mt-0">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ระยะเวลาเสนอสินค้า</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" data-daterange="true" class="datepicker form-control mt-3 xl:mt-0">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                รายละเอียดส่วนลด
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="editor" style="display: none;">
                                            <p>ร่วมนำเสนอสินค้าราคาพิเศษและกรอกแบบฟอร์มเพื่อเข้าร่วมแคมเปญ</p>
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
    const discountCodeType = document.querySelectorAll('input[name=discount-code-type]')
    const selectProEl = document.querySelector('#select-product')

    discountCodeType.forEach(radio => {
        radio.addEventListener('change', () => {
            let id = radio.getAttribute('id')
            id === 'discount-product' ? selectProEl.classList.remove('hidden') : selectProEl.classList.add('hidden')
        })

    })

    const selectAllEl = document.querySelector('#selectall')
    const selectEl = document.querySelectorAll('.select-product')

    selectAllEl.addEventListener('change', () => {
        selectAllEl.checked === true ? selectEl.forEach(item => item.checked = true) : selectEl.forEach(item => item.checked = false)
    })


    const discountType = document.querySelectorAll('input[name=discount-type]')
    const iconEl = document.querySelectorAll('.icon-discount')
    const inputEl = document.querySelectorAll('.disable-input')

    const switchIcon = () => {

        discountType.forEach(item => {
            let chkEl = item.checked === true

            iconEl.forEach(icon => {
                item.getAttribute('id') === 'discount-value' && chkEl ? icon.textContent = '฿' :
                item.getAttribute('id') === 'discount-percent' && chkEl ? icon.textContent = '%' :
                item.getAttribute('id') === 'discount-point' && chkEl ? icon.textContent = 'coins' :
                    undefined
            })
        })
    }

    switchIcon()

    discountType.forEach(item => {
        item.addEventListener('change', switchIcon)
    })
</script>
@endsection

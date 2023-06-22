@extends('layouts.Admin.app')

@section('content')
<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5 mt-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        ข้อมูลโปรโมชันส่วนลดสินค้า
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
                            <input id="" type="text" class="form-control mt-3 xl:mt-0" placeholder="ชื่อโปรโมชัน" value="ขนมกล้วยคลีนซื้อ 1 ชิ้น แถม 1">
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

                            <div class="flex flex-col sm:flex-row mt-3 xl:mt-0">
                                <div class="form-check mr-2">
                                    <input id="discount-percent" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-chris-evans" checked>
                                    <label class="form-check-label" for="discount-percent">% ส่วนลด</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="discount-value" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-liam-neeson">
                                    <label class="form-check-label" for="discount-value">มูลค่าส่วนลด</label>
                                </div>
                                <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input id="special-deals" class="form-check-input" type="radio" name="discount-type" value="horizontal-radio-liam-neeson">
                                    <label class="form-check-label" for="special-deals">ดีลพิเศษ</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">ซื้อจำนวน</div>
                                        <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mr-5 mt-3 xl:mt-0">
                                <input type="text" class="form-control">
                                <div id="" class="input-group-text">ชิ้น</div>
                            </div>

                            <div class="flex flex-col xl:flex-row xl:items-center mt-3 xl:mt-0">
                                <label class="form-lable font-medium xl:px-5">ลด</label>
                                <div class="input-group mt-3 xl:mt-0">
                                    <input type="text" class="form-control">
                                    <div id="" class="input-group-text"><span class="icon-discount"></span></div>
                                </div>
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
                                <input type="text" class="form-control">
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="intro-y box p-5 mt-5">
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
                            <input type="text" data-daterange="true" class="datepicker form-control mt-3 xl:mt-0">
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
    const radioMaximum = document.querySelectorAll('input[name=maximum-discount]')
    const inputSpecifyEl = document.querySelector('#specify')

    console.log(radioMaximum);
    console.log(inputSpecifyEl);

    const hideSpecifyEl = () => {
        radioMaximum.forEach(item => {

            let id = item.getAttribute('id')
            let chkEl = item.checked === true

            id === 'unlimit-value' && chkEl ? inputSpecifyEl.classList.add('hidden') : inputSpecifyEl.classList.remove('hidden')

        })
    }

    radioMaximum.forEach(radio => {
        radio.addEventListener('change', hideSpecifyEl)
    })

    const selectAllEl = document.querySelector('#selectall')
    const selectEl = document.querySelectorAll('.select-product')

    selectAllEl.addEventListener('change', () => {
        selectAllEl.checked === true ? selectEl.forEach(item => item.checked = true) : selectEl.forEach(item => item.checked = false)
    })


    const discountType = document.querySelectorAll('input[name=discount-type]')
    const iconEl = document.querySelector('.icon-discount')

    console.log(discountType);
    console.log(iconEl);

    const switchIcon = () => {

        discountType.forEach(item => {
            let chkEl = item.checked === true

            item.getAttribute('id') === 'discount-percent' && chkEl ? iconEl.textContent = '%' :
                item.getAttribute('id') === 'discount-value' && chkEl ? iconEl.textContent = '฿' :
                item.getAttribute('id') === 'special-deals' && chkEl ? iconEl.textContent = '฿' :
                undefined
        })
    }

    switchIcon()

    discountType.forEach(item => {
        item.addEventListener('change', switchIcon)
    })
</script>
@endsection

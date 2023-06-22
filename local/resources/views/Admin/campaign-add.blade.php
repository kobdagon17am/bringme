@extends('layouts.Admin.app')

@section('content')
<div class="content">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12">
                    <!-- BEGIN: Form Layout -->
                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                ข้อมูลแคมเปญ
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">แคมเปญ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="" type="text" class="form-control" placeholder="ชื่อแคมเปญ" value="[1-31 มีนาคม 66] Bring Me จัดแคมเปญดีลลดเดือด 3.3 Month Sale">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">ประเภทแคมเปญ</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="form-check mr-2">
                                                <input id="discount" class="form-check-input" type="radio" name="discount" value="">
                                                <label class="form-check-label" for="discount">ส่วนลด</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="radio-switch-5" class="form-check-input" type="radio" name="discount" value="">
                                                <label class="form-check-label" for="radio-switch-5">ของแถม</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0 hidden" id="discountoption">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="form-check mr-2">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">มูลค่า</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">เปอร์เซ็นต์</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">คะแนน</label>
                                            </div>
                                        </div>
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
                                    <input type="text" data-daterange="true" class="datepicker form-control">
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
                                    <input type="text" data-daterange="true" class="datepicker form-control">
                                </div>

                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0 hidden" id="discountoption">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียดส่วนลด</div>
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="flex flex-col sm:flex-row">
                                            <div class="form-check mr-2">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">มูลค่า</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">เปอร์เซ็นต์</label>
                                            </div>
                                            <div class="form-check mr-2 mt-2 sm:mt-0">
                                                <input id="" class="form-check-input" type="radio" name="dis" value="">
                                                <label class="form-check-label" for="">คะแนน</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="intro-y box p-5 mt-5">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                รายละเอียดแคมเปญ
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="form-label xl:w-64 xl:!mr-10">
                                        <div class="text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">รายละเอียดแคมเปญ</div>
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
    const radioBtn = document.querySelectorAll('input[name="discount"]')
    const radioDis = document.querySelector('#discount')
    const discountOption = document.querySelector('#discountoption')

    console.log(radioBtn);

    for (let i = 0; i < radioBtn.length; i++) {

        radioBtn[i].addEventListener('change', () => {
            radioDis.checked ? discountOption.classList.remove('hidden') : discountOption.classList.add('hidden')
        })

    }
</script>

@endsection

@extends('layouts.backend.app')

@section('content')
<div class="content">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">รายละเอียดขอคืนเงิน</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">อนุมัติ</button>
            <button class="btn btn-outline-danger shadow-md mr-2">ปฏิเสธ</button>
        </div>
    </div>

    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดคำสั่งซื้อ</div>
                    <a href="" class="flex items-center ml-auto text-primary">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> เปลี่ยนสถานะ
                    </a>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> คำสั่งซื้อ: <a href="" class="underline decoration-dotted ml-1">#20220217/MPL/2053411933</a>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2">
                    </i> วันที่สั่งซื้อ: 24 มีนาคม 2022
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-500 mr-2"></i> สถานะคำสั่งซื้อ: <span class="bg-success/20 text-success rounded px-2 ml-1">สำเร็จ</span>
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดผู้ซื้อ</div>
                    <a href="user-detail.php" class="flex items-center ml-auto text-primary">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> รายละเอียด
                    </a>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> ชื่อ: <a href="" class="underline decoration-dotted ml-1">วีรพล อุดมทรัพย์</a>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> หมายเลขโทรศัพท์: +71828273732
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ที่อยู่: 782 ถนน วิภาวดีรังสิต แขวง สนามบิน เขตดอนเมือง กรุงเทพมหานคร 10900
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดการจ่ายเงิน</div>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2">
                    </i> วิธีการชำระเงิน: <div class="ml-auto">โอนเงินผ่านธนาคารโดยตรง</div>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ราคารวม: <div class="ml-auto">฿12,500.00</div>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ค่าจัดส่งทั้งหมด : <div class="ml-auto">฿1,500.00</div>
                </div>
                <div class="flex items-center border-t border-slate-200/60 dark:border-darkmode-400 pt-5 mt-5 font-medium">
                    <i data-lucide="credit-card" class="lucide lucide-credit-card w-4 h-4 text-slate-500 mr-2"></i> รวมทั้งสิ้น: <div class="ml-auto">฿14,000.00</div>
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">ข้อมูลการจัดส่ง</div>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> บริการจัดส่ง: j&t express
                </div>
                <div class="flex items-center mt-3">
                    <i xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="calendar" data-lucide="calendar" class="lucide lucide-calendar w-4 h-4 text-slate-500 mr-2">
                    </i> หมายเลขพัสดุ: 003005580322 <i data-lucide="copy" class="w-4 h-4 text-slate-500 ml-2"></i>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ที่อยู่: 782 ถนน วิภาวดีรังสิต แขวง สนามบิน เขตดอนเมือง กรุงเทพมหานคร 10900
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายการสินค้า</div>
                </div>
                <div class="overflow-auto lg:overflow-visible -mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap !py-5">สินค้า</th>
                                <th class="whitespace-nowrap text-right">ราคาต่อหน่วย</th>
                                <th class="whitespace-nowrap text-right">จำนวน</th>
                                <th class="whitespace-nowrap text-right">ราคา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="!py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="rounded-lg border-2 border-white shadow-md tooltip" src="http://rubick-laravel.left4code.com/dist/images/preview-13.jpg">
                                        </div>
                                        <a href="" class="font-medium whitespace-nowrap ml-4">Oppo Find X2 Pro</a>
                                    </div>
                                </td>
                                <td class="text-right">฿50,000.00</td>
                                <td class="text-right">2</td>
                                <td class="text-right">฿100,000.00</td>
                            </tr>
                            <tr>
                                <td class="!py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="rounded-lg border-2 border-white shadow-md tooltip" src="http://rubick-laravel.left4code.com/dist/images/preview-7.jpg">
                                        </div>
                                        <a href="" class="font-medium whitespace-nowrap ml-4">Nikon Z6</a>
                                    </div>
                                </td>
                                <td class="text-right">฿50,000.00</td>
                                <td class="text-right">2</td>
                                <td class="text-right">฿100,000.00</td>
                            </tr>
                            <tr>
                                <td class="!py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="rounded-lg border-2 border-white shadow-md tooltip" src="http://rubick-laravel.left4code.com/dist/images/preview-10.jpg">
                                        </div>
                                        <a href="" class="font-medium whitespace-nowrap ml-4">Samsung Q90 QLED TV</a>
                                    </div>
                                </td>
                                <td class="text-right">฿55,000.00</td>
                                <td class="text-right">2</td>
                                <td class="text-right">฿110,000.00</td>
                            </tr>
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="rounded-lg border-2 border-white shadow-md tooltip" src="http://rubick-laravel.left4code.com/dist/images/preview-9.jpg">
                                        </div>
                                        <a href="" class="font-medium whitespace-nowrap ml-4">Nike Air Max 270</a>
                                    </div>
                                </td>
                                <td class="text-right">฿46,000.00</td>
                                <td class="text-right">2</td>
                                <td class="text-right">฿92,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

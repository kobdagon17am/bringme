@extends('layouts.Customer.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        เบิกจ่ายสินค้าจากคลัง
    </h2>

    <div class="box mt-5 p-5">
        <h2 class="intro-y text-md font-medium">
            รายการเลขพัสดุบริษัทบนส่ง
        </h2>
        <div class="intro-y  overflow-x-auto mt-5">
            <table class="table table-bordered table-hover">
                <thead class="whitespace-nowrap text-center">
                    <tr class="whitespace-nowrap">
                        <th class="">Recipnt Code (รหัสผู้รับ)</th>
                        <th class="">Recipnt Name (ชื่อผู้รับ)/ Address (ที่อยู่ผู้รับ)</th>
                        <th class="">ส่งรายการให้ Kerry เพื่อขอเลขพัสดุ</th>
                        <th class="">หมายเลขพัสดุ (Consignment number)</th>
                        <th class="">รายละเอียดลูกค้า</th>
                        <th class="">ใบเสร็จ</th>
                        <th class="">จำนวนกล่อง</th>
                        <th class="">ใบปะหน้ากล่อง</th>
                        <th class="">ยกเลิกรายการ</th>
                    </tr>
                </thead>
                <tbody class="whitespace-nowrap text-center">
                    <tr>
                        <td class="">P106349</td>
                        <td class="">นายจรูญ อินทนาศักดิ์ (ตย.)2102/1 อาคารไอยเรศวร</td>
                        <td class=""><button class="btn btn-primary">Export Excel</button></td>
                        <td class=""></td>
                        <td class="text-center"><a href="javascript:;" class="text-primary"><i data-lucide="printer" class="w-5 h-5 mx-auto"></i></a></td>
                        <td class="text-center"><a href="javascript:;" class="text-primary"><i data-lucide="printer" class="w-5 h-5 mx-auto"></i></a></td>
                        <td class=""><input type="number" class="form-control" value="1"></td>
                        <td class="text-center"><a href="javascript:;" class="text-primary"><i data-lucide="printer" class="w-5 h-5 mx-auto"></i></a></td>
                        <td class="text-center"><a href="javascript:;" class="text-danger"><i data-lucide="trash-2" class="w-5 h-5 mx-auto"></i></a></td>
                    </tr>

                </tbody>
            </table>
        </div>

        <h2 class="intro-y text-md font-medium mt-5">
            นำเข้าเลขพัสดุจาก Kerry
        </h2>

        <div class="flex items-center gap-5 mt-5">
            <input type="file">
            <button class="btn btn-primary">IMPORT</button>
            <button class="btn btn-pending">Clear เพื่อนำเข้าใหม่</button>
            <button class="btn btn-primary"><i data-lucide="printer" class="w-4 h-4 mr-2"></i>พิมพ์ใบเบิกสินค้า</button>
        </div>

        <div class="intro-y  overflow-x-auto mt-5">
            <table class="table table-bordered table-hover">
                <thead class="whitespace-nowrap">
                    <tr class="">
                        <th class="text-center">รหัสใบเบิก</th>
                        <th class="">รายการบิลในใบเบิก <span class="underline underline-offset-4">(คลิกที่รายการเพื่อ Scan)</span></th>
                    </tr>
                </thead>
                <tbody class="whitespace-nowrap">
                    <tr>
                        <td class="text-center">P200527</td>
                        <td class="">-P106349(Packing list) : 0123032000001,0123032000002</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <h2 class="intro-y text-md font-medium mt-5">
            นำเข้าเลขพัสดุจาก Kerry
        </h2>

        <div class="flex items-center justify-center gap-5">
            <button class="btn btn-primary">แจ้งสถานะว่า Packing เรียบร้อยแล้ว</button>
            <button class="btn btn-primary" disabled>บริษัทขนส่งเข้ารับสินค้าแล้ว</button>
        </div>


    </div>

</div>

@endsection
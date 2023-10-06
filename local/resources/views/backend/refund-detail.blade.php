@extends('layouts.backend.app')
<style type="text/css">
    /* Styles for the modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding: 20px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
    }

    .modal-content {
        max-width: 100%;
        max-height: 80%;
        display: block;
        margin: 0 auto;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
    }

</style>
@section('content')
<div class="content">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">รายละเอียดขอคืนเงิน</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <?php 
                $url_unapprove = url('admin/approve_payment_unapprove',['id'=>$refund_id]);
                $url_approve = url('admin/approve_payment_approve',['id'=>$refund_id]);

                echo '<a  href="'.$url_unapprove.'"> <button class="btn btn-outline-danger shadow-md mr-2">ปฏิเสธ</button> </a>';
                echo '<a  href="'.$url_approve.'"> <button class="btn btn-primary shadow-md mr-2">อนุมัติ</button> </a>';
            ?>
        </div>
    </div>

    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดคำสั่งซื้อ</div>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> คำสั่งซื้อ: <b class="underline decoration-dotted ml-1">{{$order_detail['data']['cart']->order_number}}</b>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2">
                    </i> วันที่สั่งซื้อ: {{date('Y/m/d',strtotime($order_detail['data']['cart']->created_at))}}
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="clock" class="w-4 h-4 text-slate-500 mr-2"></i> สถานะคำสั่งซื้อ:
                    {{-- 0.ยังไม่บันทึก 1.รออนุมัติ 2.ชำระเงินสำเร็จ 3.ยกเลิก --}}
                    @if($order_detail['data']['cart']->status == 1)
                    <span class="bg-success/20 text-warning rounded px-2 ml-1">รออนุมัติ</span>
                    @endif
                    @if($order_detail['data']['cart']->status == 2)
                    <span class="bg-success/20 text-success rounded px-2 ml-1">ชำระเงินสำเร็จ</span>
                    @endif
                    @if($order_detail['data']['cart']->status == 3)
                    <span class="bg-success/20 text-danger rounded px-2 ml-1">ยกเลิก</span>
                    @endif
                </div>
            </div>
            <?php
            // dd($order_detail['data']);

            ?>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดผู้ซื้อ</div>
                    {{-- <a href="user-detail.php" class="flex items-center ml-auto text-primary">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i> รายละเอียด
                    </a> --}}
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> ชื่อ: <a href="" class="underline decoration-dotted ml-1"> {{$order_detail['data']['cart']->customer_name}} </a>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> หมายเลขโทรศัพท์: {{$order_detail['data']['customer_address']->tel}}
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-500 mr-2">
                    </i>

                    ที่อยู่: {{ $order_detail['data']['customer_address']->address_number }} แขวง {{ $order_detail['data']['customer_address']->amphures_name }} เขต {{ $order_detail['data']['customer_address']->districts_name }} {{ $order_detail['data']['customer_address']->provinces_name }} {{ $order_detail['data']['customer_address']->zipcode }}
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดการจ่ายเงิน</div>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2">
                    </i> วิธีการชำระเงิน: <div class="ml-auto">{{ $order_detail['data']['cart']->pay_type_name }}</div>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ราคารวม: <div class="ml-auto">฿{{ number_format($order_detail['data']['cart']->total_price,2,'.',',') }}</div>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ค่าจัดส่งทั้งหมด : <div class="ml-auto">฿{{ number_format($order_detail['data']['cart']->shipping_price,2,'.',',') }}</div>
                </div>
                <div class="flex items-center border-t border-slate-200/60 dark:border-darkmode-400 pt-5 mt-5 font-medium">
                    <i data-lucide="credit-card" class="lucide lucide-credit-card w-4 h-4 text-slate-500 mr-2"></i> รวมทั้งสิ้น: <div class="ml-auto">฿{{ number_format($order_detail['data']['cart']->grand_total,2,'.',',') }}</div>
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">ข้อมูลการจัดส่ง</div>
                </div>
                <div class="flex items-center">
                    <i data-lucide="clipboard" class="w-4 h-4 text-slate-500 mr-2"></i> บริการจัดส่ง: {{ $order_detail['data']['cart']->delivery_type_name }}
                </div>
                <div class="flex items-center mt-3">
                    <i xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="calendar" data-lucide="calendar" class="lucide lucide-calendar w-4 h-4 text-slate-500 mr-2">
                    </i> หมายเลขพัสดุ: {{ $order_detail['data']['tracking_no1'] }} <i data-lucide="copy" class="w-4 h-4 text-slate-500 ml-2"></i>
                </div>
                <div class="flex items-center mt-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-500 mr-2">
                    </i> ที่อยู่: {{ $order_detail['data']['customer_address']->address_number }} แขวง {{ $order_detail['data']['customer_address']->amphures_name }} เขต {{ $order_detail['data']['customer_address']->districts_name }} {{ $order_detail['data']['customer_address']->provinces_name }} {{ $order_detail['data']['customer_address']->zipcode }}
                </div>
            </div>
        </div>
        <?php $url_img = asset('local/storage/app/public'); ?>
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">รายละเอียดการขอเคลม</div>
                </div>
                <div class="grid grid-cols-12 -mt-3">
                    <div class="font-medium text-base truncate col-span-12 lg:col-span-12 xl:col-span-12">ภาพรายละเอียด</div>
                    @if(!empty($refund->img1))
                    <img style="height: 200px; cursor: pointer;" class="image rounded-md col-span-4 lg:col-span-4 xl:col-span-4" src=" {{($url_img .'/'. $refund->img_path . '' . $refund->img1)}}">
                    @endif
                    @if(!empty($refund->img2))
                    <img style="height: 200px; cursor: pointer;" class="image rounded-md col-span-4 lg:col-span-4 xl:col-span-4" src=" {{($url_img .'/'. $refund->img_path . '' . $refund->img2)}}">
                    @endif
                    @if(!empty($refund->img3))
                    <img style="height: 200px; cursor: pointer;" class="image rounded-md col-span-4 lg:col-span-4 xl:col-span-4" src=" {{($url_img .'/'. $refund->img_path . '' . $refund->img3)}}">
                    @endif
                </div>
                <div class="overflow-auto lg:overflow-visible mt-4">
                    <?php 
                        if($refund->problem_id == 1){
                            $problem = 'สินค้ามีปัญหาระหว่างการจัดส่ง';
                        }elseif($refund->problem_id == 2){
                            $problem = 'ตรวจสอบสินค้าแล้วพบว่าเกินกำหนดเวลาตามฉลากวันหมดอายุ';
                        }else{
                            $problem = 'อื่นๆ '.$refund->other_problem;
                        }
                    ?>
                    <div class="font-medium text-base truncate">ปัญหา : {{ $problem }}</div>
                </div>
            </div>

            <div class="box p-5 rounded-md mt-4">
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
                            @foreach($order_detail['data']['products'] as $value)
                            <?php 
                                $products = DB::table('products')->where('id',$value->product_id)->first();
                            ?>
                            <tr>
                                <td class="!py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="rounded-lg border-2 border-white shadow-md tooltip"
                                            src=" {{($url_img .'/'. $value->img_path . '' . $value->img_name)}}">
                                        </div>
                                        <a href="" class="font-medium whitespace-nowrap ml-4">{{ $products->name_th }}</a>
                                    </div>
                                </td>
                                <td class="text-right">{{$value->price}}</td>
                                <td class="text-right">{{$value->qty}}</td>
                                <td class="text-right">{{$value->total_price}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-image">
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript">
    // When an image is clicked, display it in the modal
    $(".image").click(function() {
        var imgSrc = $(this).attr("src");
        console.log(imgSrc);
        $("#modal-image").attr("src", imgSrc);
        $(".modal").css("display", "block");
    });

    // Close the modal when the close button or outside the modal is clicked
    $(".close, .modal").click(function() {
        $(".modal").css("display", "none");
    });

    // Prevent modal from closing when clicking on the image itself
    $(".modal-content").click(function(event) {
        event.stopPropagation();
    });

</script>
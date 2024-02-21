


@extends('layouts.frontend.app')
<title>รายละเอียดร้านค้า</title>
<style type="text/css">
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #aaa;
        border-radius: 3px;
        padding: 5px;
        background-color: transparent;
        color: inherit;
        padding: 4px;
        width: 65px;
    }
</style>
@section('content')
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            รายละเอียดร้านค้า
        </h2>
    </div>

    <!-- BEGIN: Profile Info -->
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">

                    @if(!empty($store->profile_img))
                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('local/storage/app/public') }}/{{ $store->profile_img_path }}{{ $store->profile_img }}">
                    @else
                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                    @endif

                    <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2"> <i class="w-4 h-4 text-white" data-lucide="camera"></i> </div>
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ (!empty($store) ? $store->firstname : '') }}</div>
                    <!-- <div class="text-slate-500">Frontend Engineer</div> -->
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">รายละเอียดการติดต่อ</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">

                    <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> {{ (!empty($store) ? $store->email : '' ) }} </div>
                    {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="instagram" class="w-4 h-4 mr-2"></i>{{ (!empty($store) ? $store->firstname : '') }} </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i>{{ (!empty($store) ? $store->firstname : '') }} </div> --}}
                </div>
            </div>
            {{-- <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-5">Sales Growth</div>
                <div class="flex items-center justify-center lg:justify-start mt-2">
                    <div class="mr-2 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                    <div class="w-3/4">
                        <div class="h-[55px]">
                            <canvas class="simple-line-chart-1 -mr-5"></canvas>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center lg:justify-start">
                    <div class="mr-2 w-20 flex"> STP: <span class="ml-3 font-medium text-danger">-2%</span> </div>
                    <div class="w-3/4">
                        <div class="h-[55px]">
                            <canvas class="simple-line-chart-2 -mr-5"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>





        <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
            <li id="dashboard-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4 active" data-tw-target="#dashboard" aria-controls="dashboard" aria-selected="true" role="tab"> แดชบอร์ด </a> </li>
            <li id="product-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4" data-tw-target="#product" aria-selected="false" role="tab"> สินค้าทั้งหมด </a> </li>
            <li id="profile-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4" data-tw-target="#profile" aria-selected="false" role="tab"> ข้อมูลร้านค้า </a> </li>
        </ul>
    </div>
    <!-- END: Profile Info -->

    <div class="tab-content mt-5">
        <div id="dashboard" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-5-tab">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                            <div class="text-base text-slate-500 mt-1">สินค้าที่ขายได้</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="credit-card" class="report-box__icon text-pending"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                            <div class="text-base text-slate-500 mt-1">คำสั่งซื้อใหม่</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="monitor" class="report-box__icon text-warning"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                            <div class="text-base text-slate-500 mt-1">สินค้าทั้งหมด</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-lucide="user" class="report-box__icon text-success"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                            <div class="text-base text-slate-500 mt-1">ผู้เข้าชม</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y mt-12">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        แนวโน้มยอดขายใน Real-time
                    </h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                        <i data-lucide="calendar" class=" w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0">
                        </i>
                        <input type="text" class="datepicker form-control sm:w-56 box pl-10" data-single-mode="true">
                    </div>
                </div>
                <div class="box p-5 mt-8">
                    <div class="report-chart">
                        <div class="h-[275px]">
                            <canvas id="report-line-chart" class="mt-6 -mb-6" width="1288" height="550"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y mt-5">
                <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center box" role="tablist">
                    <li id="sales-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4 active" data-tw-target="#sales" aria-controls="dashboard" aria-selected="true" role="tab"> ยอดขาย </a> </li>
                    <li id="numberofproducts-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4" data-tw-target="#numberofproducts" aria-selected="false" role="tab"> จำนวนสินค้า </a> </li>
                    <li id="productviews-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-4" data-tw-target="#productviews" aria-selected="false" role="tab"> ยอดชมสินค้า </a> </li>
                </ul>

                <div class="tab-content py-5 mt-5">
                    <div id="sales" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-5-tab">
                        <table class="table table-report -mt-2 datatable">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">ยอดขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($product))
                                    <?php $i = 1; ?>
                                    @foreach($product as $_product)
                                        <tr class="intro-x">
                                            <td class="w-auto">{{ $i }}</td>
                                            <td class="w-auto">
                                                <div class="w-10 h-10 image-fit zoom-in">
                                                    @if(!empty($_product->gallery_name))
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('local/storage/app/public') }}/{{ $_product->gallery_path }}{{ $_product->gallery_name }}">
                                                    @else
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a href="" class="font-medium whitespace-nowrap"> TH : {{ $_product->product_name_th }} | EN : {{ $_product->product_name_en }} </a>
                                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"> TH : {{ $_product->brands_name_th }} | EN : {{ $_product->brands_name_en }}</div>
                                            </td>
                                            <td class="text-center">{{ number_format($_product->max_price,2) }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div id="numberofproducts" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
                        <table class="table table-report -mt-2 datatable">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">จำนวนสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($product))
                                    <?php $i = 1; ?>
                                    @foreach($product as $_product)
                                        <tr class="intro-x">
                                            <td class="w-auto">{{ $i }}</td>
                                            <td class="w-auto">
                                                <div class="w-10 h-10 image-fit zoom-in">
                                                    @if(!empty($_product->gallery_name))
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('local/storage/app/public') }}/{{ $_product->gallery_path }}{{ $_product->gallery_name }}">
                                                    @else
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a href="" class="font-medium whitespace-nowrap"> TH : {{ $_product->product_name_th }} | EN : {{ $_product->product_name_en }} </a>
                                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"> TH : {{ $_product->brands_name_th }} | EN : {{ $_product->brands_name_en }}</div>
                                            </td>
                                            <td class="text-center">{{ number_format($_product->max_price,2) }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div id="productviews" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
                        <table class="table table-report -mt-2 datatable">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">ยอดชมสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($product))
                                    <?php $i = 1; ?>
                                    @foreach($product as $_product)
                                        <tr class="intro-x">
                                            <td class="w-auto">{{ $i }}</td>
                                            <td class="w-auto">
                                                <div class="w-10 h-10 image-fit zoom-in">
                                                    @if(!empty($_product->gallery_name))
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('local/storage/app/public') }}/{{ $_product->gallery_path }}{{ $_product->gallery_name }}">
                                                    @else
                                                    <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <a href="" class="font-medium whitespace-nowrap"> TH : {{ $_product->product_name_th }} | EN : {{ $_product->product_name_en }} </a>
                                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"> TH : {{ $_product->brands_name_th }} | EN : {{ $_product->brands_name_en }}</div>
                                            </td>
                                            <td class="text-center">{{ number_format($_product->max_price,2) }}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="product" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 flex items-center ml-auto mt-2">
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-80 relative text-slate-500">
                            <a href="{{ url('product_add') }}/{{$id}}" targer="_blank"><button type="button" class="btn btn-primary">เพิ่มสินค้าใหม่</button></a>
                            <input type="text" class="form-control w-56 box pr-10" placeholder="ค้นหา...">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search">
                            </i>
                        </div>
                    </div>
                </div>
                @if(!empty($product))
                    @foreach($product as $_product)
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                            <div class="box">
                                <div class="p-5">
                                    <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">

                                        @if(!empty($_product->gallery_name))
                                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{ asset('local/storage/app/public') }}/{{ $_product->gallery_path }}{{ $_product->gallery_name }}">
                                        @else
                                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                        @endif

                                        {{-- <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                            <a href="" class="block font-medium text-base">{{ $_product->product_name_th }} | {{ $_product->product_name_en }}</a>
                                            <span class="text-white/90 text-xs mt-3">TH : {{ $_product->category_name_th }} | EN : {{ $_product->category_name_en }}
                                            <br>TH : {{ $_product->brands_name_th }} | EN : {{ $_product->brands_name_en }}</span>
                                        </div> --}}
                                    </div>
                                    <div class="text-slate-600 dark:text-slate-500 mt-5">

                                        <p>{{ $_product->product_name_th }} | {{ $_product->product_name_en }} <br>
                                            TH : {{ $_product->brands_name_th }} | EN : {{ $_product->brands_name_en }}</p>

                                        <div class="flex items-center">
                                            <i data-lucide="link" class="w-4 h-4 mr-2"></i> ราคา: ฿ {{ number_format($_product->max_price,2) }}
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <i data-lucide="layers" class="w-4 h-4 mr-2"></i> จำนวน: {{ $_product->qty }}
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> สถานะ: {{ ($_product->approve_status == 1 ? 'Active' : 'Deactive') }}
                                            <a href="{{ url('product-edit') }}/{{ $_product->id }}" style="float: right;margin-left: 40%; cursor: pointer;"><i data-lucide="settings" class="w-4 h-4 mr-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div id="profile" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
            <form class="grid grid-cols-12 gap-6" method="POST" action="{{ url('store_update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $id }}">
                <input type="hidden" name="store_id" value="{{ @$store_detail->id }}">
                <div class="col-span-12">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลส่วนตัว
                            </h2>
                        </div>
                        <!-- <div class="p-5"> -->
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                                    <div>
                                        <label for="" class="form-label">ชื่อ-นามสกุล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="firstname" value="{{ $store->firstname }}">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">วันเดือนปีเกิด</label>
                                        <div class="relative">
                                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> <i data-lucide="calendar" class="w-4 h-4"></i> </div> <input type="text" class="datepicker form-control pl-12" data-single-mode="true" name="birthday" value="{{ $store->birthday }}">
                                        </div>
                                    </div>

                                    <?php
                                        $dateOfBirth = $store->birthday;
                                        $dob = new DateTime($dateOfBirth);
                                        $now = new DateTime();
                                        $diff = $now->diff($dob);
                                    ?>

                                    <div>
                                        <label for="" class="form-label">อายุ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" readonly value="{{ $diff->y }}">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">อีเมล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="email" value="{{ $store->email }}">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">เบอร์ติดต่อ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="tel" value="{{ $store->tel }}">
                                    </div>

                                </div>

                                <div class="flex items-center p-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        ข้อมูลที่อยู่
                                    </h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                                    <div>
                                        <label for="" class="form-label">ห้อง/บ้านเลขที่</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="address" value="{{ $store->address }}">
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                        <select id="update-profile-form-8" class="form-select" name="province_id">
                                            <option value="">- เลือกจังหวัด -</option>
                                            @if(!empty($provinces))
                                                @foreach($provinces as $_provinces)
                                                    <option {{ ($_provinces->id == $store->province_id ? 'selected' : '') }} value="{{ $_provinces->id }}">{{ $_provinces->name_th }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                        <select id="update-profile-form-8" class="form-select" name="amphures_id">
                                            <option value="">- เลือกเขต -</option>
                                            @if(!empty($amphures))
                                                @foreach($amphures as $_amphures)
                                                    <option {{ ($_amphures->id == $store->amphures_id ? 'selected' : '') }} value="{{ $_amphures->id }}">{{ $_amphures->name_th }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">แขวง/ตำบล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="district_id" value="{{ $store->district_id }}">
                                        {{-- <select id="update-profile-form-8" class="form-select" name="district_id">
                                            <option value="">- เลือกแขวง -</option>
                                            @if(!empty($districts))
                                                @foreach($districts as $_districts)
                                                    <option {{ ($_districts->id == $store->district_id ? 'selected' : '') }} value="{{ $_districts->id }}">{{ $_districts->name_th }}</option>
                                                @endforeach
                                            @endif
                                        </select> --}}
                                    </div>

                                    <div>
                                        <label for="" class="form-label">รหัสไปรษณีย์</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" name="zipcode" value="{{ $store->zipcode }}">
                                    </div>

                                </div>

                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        @if(!empty($store->profile_img))
                                        <img alt="Midone - HTML Admin Template" class="profile_show tooltip rounded-full" src="{{ asset('local/storage/app/public') }}/{{ $store->profile_img_path }}{{ $store->profile_img }}">
                                        @else
                                        <img alt="Midone - HTML Admin Template" class="profile_show tooltip rounded-full" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                        @endif
                                        <div title="Remove this profile photo?" class="remove_profile_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile_img" name="profile_img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- END: Display Information -->
                        <!-- BEGIN: Personal Information -->
                    </div>

                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลร้านค้า
                            </h2>
                        </div>
                        <!-- <div class="p-5"> -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                            <div>
                                <label for="" class="form-label">ชื่อแบรนด์</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="{{ (!empty($store_detail) ? $store_detail->store_name : '') }}" name="store_name">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">ประเภทสินค้า</label>
                                <select id="update-profile-form-8" class="form-select" name="category_id">
                                    <option value="">- เลือกประเภทสินค้า -</option>
                                    @if(!empty($category))
                                        @foreach($category as $_category)
                                            <option {{ (!empty($store_detail) ? ($_category->id == $store_detail->category_id ? 'selected' : '') : '') }} value="{{ $_category->id }}">{{ $_category->name_th }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รายละเอียดเกี่ยวกับแบรนด์และสินค้า</label>
                                <textarea class="form-control" id="" rows="5" name="brand_product_detail">{{ (!empty($store_detail) ? nl2br($store_detail->brand_product_detail) : '') }}</textarea>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">วิธีการจัดเก็บสินค้า</label>
                                <select id="update-profile-form-8" class="form-select" name="storage_method_id">
                                    <option value="">- เลือกวิธีการจัดเก็บสินค้า -</option>
                                    @if(!empty($storage_method))
                                        @foreach($storage_method as $_storage_method)
                                            <option {{ (!empty($store_detail->storage_method_id) ? ($_storage_method->id == $store_detail->storage_method_id ? 'selected' : '') : '') }} value="{{ $_storage_method->id }}">{{ $_storage_method->name_th }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">Shelf-life</label>
                                <input id="" type="text" class="form-control" name="shelf_lift" placeholder="Input text" value="{{ (!empty($store_detail) ? $store_detail->shelf_lift : '') }}">
                            </div>

                            <div>
                                <label for="" class="form-label">จำนวนรายการสินค้า (SKU)</label>
                                <input id="" type="text" class="form-control" name="qty_sku" placeholder="Input text" value="{{ (!empty($store_detail) ? $store_detail->qty_sku : '') }}">
                            </div>

                            <div>
                                <label for="" class="form-label">วันที่พร้อมส่ง</label>
                                <div class="relative">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="datepicker form-control pl-12" data-single-mode="true" name="shipping_date" value="{{ (!empty($store_detail) ? $store_detail->shipping_date : '') }}">
                                </div>
                            </div>

                            <div>
                                <label for="" class="form-label">ช่องทาง social media</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" name="social" value="{{ (!empty($store_detail) ? $store_detail->social : '') }}">
                            </div>

                            <div>
                                <label for="" class="form-label">รูปแบบธุรกิจ</label><br>
                                <input id="" type="radio" name="store_type" value="1" {{ (!empty($store_detail) ? ($store_detail->store_type == 1 ? 'checked' : '') : '') }}>&nbsp;&nbsp;บุคคลธรรมดา&nbsp;&nbsp;
                                <input id="" type="radio" name="store_type" value="2" {{ (!empty($store_detail) ? ($store_detail->store_type == 2 ? 'checked' : '') : '') }}>&nbsp;&nbsp;นิติบุคคล
                            </div>

                        </div>

                        <div class="flex items-center p-5">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลที่อยู่ร้านค้า
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                            <div>
                                <label for="" class="form-label">ห้อง/บ้านเลขที่</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" name="address2" value="{{ (!empty($store_detail) ? $store_detail->address : '') }}">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                <select id="update-profile-form-8" class="form-select" name="province_id2">
                                    <option value="">- เลือกจังหวัด -</option>
                                    @if(!empty($provinces))
                                        @foreach($provinces as $_provinces)
                                            <option {{ (!empty($store_detail) ? ($_provinces->id == $store_detail->province_id ? 'selected' : '') : '') }} value="{{ $_provinces->id }}">{{ $_provinces->name_th }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                <select id="update-profile-form-8" class="form-select" name="amphures_id2">
                                    <option value="">- เลือกเขต -</option>
                                    @if(!empty($amphures))
                                        @foreach($amphures as $_amphures)
                                            <option {{ (!empty($store_detail) ? ($_amphures->id == $store_detail->amphures_id ? 'selected' : '') : '') }} value="{{ $_amphures->id }}">{{ $_amphures->name_th }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">แขวง/ตำบล</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" name="district_id" value="{{ $store->district_id }}">
                                {{-- <select id="update-profile-form-8" class="form-select" name="district_id2">
                                    <option value="">- เลือกแขวง -</option>
                                    @if(!empty($districts))
                                        @foreach($districts as $_districts)
                                            <option {{ (!empty($store_detail) ? ($_districts->id == $store_detail->district_id ? 'selected' : '') : '') }} value="{{ $_districts->id }}">{{ $_districts->name_th }}</option>
                                        @endforeach
                                    @endif
                                </select> --}}
                            </div>

                            <div>
                                <label for="" class="form-label">รหัสไปรษณีย์</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" name="zipcode2" value="{{ (!empty($store_detail) ? $store_detail->zipcode : '') }}">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างรายการสินค้า</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            @if(!empty($store_detail))
                                            <img class="rounded-md detail_show" alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->product_ex_img_path }}{{ $store_detail->product_ex_img }}">
                                            @else
                                            <img class="rounded-md detail_show" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                            @endif
                                            <div title="Remove this image?" class="remove_detail_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input name="product_ex_img" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 detail_img ">
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างสินค้าและแพ็คเกจ</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            @if(!empty($store_detail))
                                            <img class="rounded-md package_show" alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->product_pack_img_path }}{{ $store_detail->product_pack_img }}">
                                            @else
                                            <img class="rounded-md package_show" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                            @endif
                                            <div title="Remove this image?" class=" remove_package_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input  name="product_pack_img" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 package_img">
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รูปใบรับรองสินค้า / Certificate อื่นๆ (ถ้ามี)</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            @if(!empty($store_detail))
                                            <img class="rounded-md certificate_show " alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->certificate_path }}{{ $store_detail->certificate }}">
                                            @else
                                            <img class="rounded-md certificate_show " alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                            @endif
                                            <div title="Remove this image?" class="remove_certificate_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input  name="certificate" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 certificate_img ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลบัญชีธนาคาร
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label for="update-profile-form-bank" class="form-label">ชื่อธนาคาร</label>
                                    <select id="update-profile-form-bank" class="form-select" name="bank_id">
                                        <option value="">- เลือกธนาคาร -</option>
                                        @if(!empty($bank))
                                            @foreach($bank as $_bank)
                                                <option {{ (!empty($store_detail) ? ($_bank->id == $store_detail->bank_id ? 'selected' : '') : '') }} value="{{ $_bank->id }}">{{ $_bank->txt_desc }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <label for="" class="form-label">ชื่อบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" name="bank_account_name" value="{{ (!empty($store_detail) ? $store_detail->bank_account_name : '') }}">
                                </div>

                                <div>
                                    <label for="" class="form-label">เลขบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" name="bank_account_number" value="{{ (!empty($store_detail) ? $store_detail->bank_account_number : '') }}">
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                @if(!empty($store_detail))
                                                <img class="rounded-md idcard_show " alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->bank_img_path }}{{ $store_detail->id_card_img }}">
                                                @else
                                                <img class="rounded-md idcard_show " alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                @endif
                                                <div title="Remove this image?" class="remove_idcard_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input name="bank_img" type="file" class="idcard_img w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                @if(!empty($store_detail))
                                                <img class="bank_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->bank_img_path }}{{ $store_detail->bank_img }}">
                                                @else
                                                <img class="bank_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                @endif
                                                <div title="Remove this image?" class="remove_bank_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input name="id_card_img" type="file" class="bank_img w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าหนังสือรับรองบริษัท</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                @if(!empty($store_detail))
                                                <img class="company_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $store_detail->company_img_path }}{{ $store_detail->company_img }}">
                                                @else
                                                <img class="company_show rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                                @endif
                                                <div title="Remove this image?" class="remove_company_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input name="company_img" type="file" class="company_img w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- END: Personal Information -->

                    <div class="flex justify-end mt-4 gap-5">
                        <button type="reset" class="btn btn-outline-danger w-20 ">ย้อนกลับ</button>
                        <button type="submit" class="btn btn-primary w-20">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Content -->
</div>
@endsection
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/ju/dt-1.13.6/b-2.4.1/r-2.5.0/sc-2.2.0/datatables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/ju/dt-1.13.6/b-2.4.1/r-2.5.0/sc-2.2.0/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        new DataTable('.datatable');

        // Get the file input element by its class
        const fileInput = $(".profile_img");

        // Add an event listener to the file input element
        fileInput.on("change", function () {
            // Check if a file is selected
            if (fileInput[0].files && fileInput[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the profile_show class
                    $(".profile_show").attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInput[0].files[0]);
            }
        });

        function changeImage(imageElement, fileInputElement) {
            if (fileInputElement[0].files && fileInputElement[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the specified image element
                    imageElement.attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInputElement[0].files[0]);
            }
        }

        function handleImageRemoval(imageElement, fileInputElement) {
            imageElement.attr("src", "");
            fileInputElement.val("");
        }

        const profileShow = $(".profile_show");
        const removeProfileShow = $(".remove_profile_show");
        const profilefileInput = $(".profile_img");

        removeProfileShow.on("click", function () {
            handleImageRemoval(profileShow, profilefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        profilefileInput.on("change", function () {
            changeImage(profileShow, profilefileInput);
        });

        const detailShow = $(".detail_show");
        const removedetailShow = $(".remove_detail_show");
        const detailfileInput = $(".detail_img");

        removedetailShow.on("click", function () {
            handleImageRemoval(detailShow, detailfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        detailfileInput.on("change", function () {
            changeImage(detailShow, detailfileInput);
        });

        const packageShow = $(".package_show");
        const removepackageShow = $(".remove_package_show");
        const packagefileInput = $(".package_img");

        removepackageShow.on("click", function () {
            handleImageRemoval(packageShow, packagefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        packagefileInput.on("change", function () {
            changeImage(packageShow, packagefileInput);
        });

        const certificateShow = $(".certificate_show");
        const removecertificateShow = $(".remove_certificate_show");
        const certificatefileInput = $(".certificate_img");

        removecertificateShow.on("click", function () {
            handleImageRemoval(certificateShow, certificatefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        certificatefileInput.on("change", function () {
            changeImage(certificateShow, certificatefileInput);
        });

        const idcardShow = $(".idcard_show");
        const removeidcardShow = $(".remove_idcard_show");
        const idcardfileInput = $(".idcard_img");

        removeidcardShow.on("click", function () {
            handleImageRemoval(idcardShow, idcardfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        idcardfileInput.on("change", function () {
            changeImage(idcardShow, idcardfileInput);
        });

        const bankShow = $(".bank_show");
        const removebankShow = $(".remove_bank_show");
        const bankfileInput = $(".bank_img");

        removebankShow.on("click", function () {
            handleImageRemoval(bankShow, bankfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        bankfileInput.on("change", function () {
            changeImage(bankShow, bankfileInput);
        });

        const companyShow = $(".company_show");
        const removecompanyShow = $(".remove_company_show");
        const companyfileInput = $(".company_img");

        removecompanyShow.on("click", function () {
            handleImageRemoval(companyShow, companyfileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        companyfileInput.on("change", function () {
            changeImage(companyShow, companyfileInput);
        });

    });
</script>
@endsection




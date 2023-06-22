@extends('layouts.Admin.app')

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
                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                    <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2"> <i class="w-4 h-4 text-white" data-lucide="camera"></i> </div>
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">The Empty Kite</div>
                    <!-- <div class="text-slate-500">Frontend Engineer</div> -->
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">รายละเอียดการติดต่อ</div>
                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                    <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> theemptykite@gmail.com </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="instagram" class="w-4 h-4 mr-2"></i> Instagram The Empty Kite </div>
                    <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter The Empty Kite</div>
                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
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
            </div>
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
                        <table class="table table-report -mt-2">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">ยอดขาย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="intro-x">
                                    <td class="w-auto">1</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">40000</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">2</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">30000</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">3</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">15000</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                            <nav class="w-full sm:w-auto sm:mr-auto">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-left" class="lucide lucide-chevrons-left w-4 h-4" data-lucide="chevrons-left">
                                                <polyline points="11 17 6 12 11 7"></polyline>
                                                <polyline points="18 17 13 12 18 7"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                                                <polyline points="15 18 9 12 15 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                    <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-right" class="lucide lucide-chevrons-right w-4 h-4" data-lucide="chevrons-right">
                                                <polyline points="13 17 18 12 13 7"></polyline>
                                                <polyline points="6 17 11 12 6 7"></polyline>
                                            </svg> </a>
                                    </li>
                                </ul>
                            </nav>
                            <select class="w-20 form-select box mt-3 sm:mt-0">
                                <option>10</option>
                                <option>25</option>
                                <option>35</option>
                                <option>50</option>
                            </select>
                        </div>
                    </div>
                    <div id="numberofproducts" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
                        <table class="table table-report -mt-2">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">จำนวนสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="intro-x">
                                    <td class="w-auto">1</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">20</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">2</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">10</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">3</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">5</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                            <nav class="w-full sm:w-auto sm:mr-auto">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-left" class="lucide lucide-chevrons-left w-4 h-4" data-lucide="chevrons-left">
                                                <polyline points="11 17 6 12 11 7"></polyline>
                                                <polyline points="18 17 13 12 18 7"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                                                <polyline points="15 18 9 12 15 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                    <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-right" class="lucide lucide-chevrons-right w-4 h-4" data-lucide="chevrons-right">
                                                <polyline points="13 17 18 12 13 7"></polyline>
                                                <polyline points="6 17 11 12 6 7"></polyline>
                                            </svg> </a>
                                    </li>
                                </ul>
                            </nav>
                            <select class="w-20 form-select box mt-3 sm:mt-0">
                                <option>10</option>
                                <option>25</option>
                                <option>35</option>
                                <option>50</option>
                            </select>
                        </div>
                    </div>
                    <div id="productviews" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
                        <table class="table table-report -mt-2">
                            <thead class="box">
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                    <th class="text-center whitespace-nowrap">ยอดชมสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="intro-x">
                                    <td class="w-auto">1</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">150</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">2</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">120</td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="w-auto">3</td>
                                    <td class="w-auto">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-9.jpg" title="Uploaded at 20 August 2020">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                                    </td>
                                    <td class="text-center">80</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                            <nav class="w-full sm:w-auto sm:mr-auto">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-left" class="lucide lucide-chevrons-left w-4 h-4" data-lucide="chevrons-left">
                                                <polyline points="11 17 6 12 11 7"></polyline>
                                                <polyline points="18 17 13 12 18 7"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                                                <polyline points="15 18 9 12 15 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                    <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                    <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right" class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg> </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-right" class="lucide lucide-chevrons-right w-4 h-4" data-lucide="chevrons-right">
                                                <polyline points="13 17 18 12 13 7"></polyline>
                                                <polyline points="6 17 11 12 6 7"></polyline>
                                            </svg> </a>
                                    </li>
                                </ul>
                            </nav>
                            <select class="w-20 form-select box mt-3 sm:mt-0">
                                <option>10</option>
                                <option>25</option>
                                <option>35</option>
                                <option>50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="product" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 flex items-center ml-auto mt-2">
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-56 relative text-slate-500">
                            <input type="text" class="form-control w-56 box pr-10" placeholder="ค้นหา...">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search">
                            </i>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Users Layout -->
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                                <img alt="Midone - HTML Admin Template" class="rounded-md" src="http://rubick-laravel.left4code.com/dist/images/preview-1.jpg">
                                <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                    <a href="" class="block font-medium text-base">Nike Tanjun</a>
                                    <span class="text-white/90 text-xs mt-3">Sport &amp; Outdoor</span>
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center">
                                    <i data-lucide="link" class="w-4 h-4 mr-2"></i> ราคา: ฿2739
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="layers" class="w-4 h-4 mr-2"></i> จำนวน: 50
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> สถานะ: Active
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <a class="flex items-center text-primary mr-auto" href="javascript:;">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview
                                    </a>
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> ลบ
                                    </a>
                                </div> -->
                    </div>
                </div>

                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                                <img alt="Midone - HTML Admin Template" class="rounded-md" src="http://rubick-laravel.left4code.com/dist/images/preview-2.jpg">
                                <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                    <a href="" class="block font-medium text-base">Nike Tanjun</a>
                                    <span class="text-white/90 text-xs mt-3">Sport &amp; Outdoor</span>
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center">
                                    <i data-lucide="link" class="w-4 h-4 mr-2"></i> ราคา: ฿2739
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="layers" class="w-4 h-4 mr-2"></i> จำนวน: 50
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> สถานะ: Active
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <a class="flex items-center text-primary mr-auto" href="javascript:;">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview
                                    </a>
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> ลบ
                                    </a>
                                </div> -->
                    </div>
                </div>

                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                                <img alt="Midone - HTML Admin Template" class="rounded-md" src="http://rubick-laravel.left4code.com/dist/images/preview-3.jpg">
                                <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                    <a href="" class="block font-medium text-base">Nike Tanjun</a>
                                    <span class="text-white/90 text-xs mt-3">Sport &amp; Outdoor</span>
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center">
                                    <i data-lucide="link" class="w-4 h-4 mr-2"></i> ราคา: ฿2739
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="layers" class="w-4 h-4 mr-2"></i> จำนวน: 50
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> สถานะ: Active
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <a class="flex items-center text-primary mr-auto" href="javascript:;">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview
                                    </a>
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> ลบ
                                    </a>
                                </div> -->
                    </div>
                </div>

                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <div class="box">
                        <div class="p-5">
                            <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                                <img alt="Midone - HTML Admin Template" class="rounded-md" src="http://rubick-laravel.left4code.com/dist/images/preview-4.jpg">
                                <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                                    <a href="" class="block font-medium text-base">Nike Tanjun</a>
                                    <span class="text-white/90 text-xs mt-3">Sport &amp; Outdoor</span>
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-500 mt-5">
                                <div class="flex items-center">
                                    <i data-lucide="link" class="w-4 h-4 mr-2"></i> ราคา: ฿2739
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="layers" class="w-4 h-4 mr-2"></i> จำนวน: 50
                                </div>
                                <div class="flex items-center mt-2">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> สถานะ: Active
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <a class="flex items-center text-primary mr-auto" href="javascript:;">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview
                                    </a>
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> ลบ
                                    </a>
                                </div> -->
                    </div>
                </div>


                <!-- END: Users Layout -->

            </div>
        </div>
        <div id="profile" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">
            <div class="grid grid-cols-12 gap-6">

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
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="รชานนท์ พงศ์พินิจ">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">วันเดือนปีเกิด</label>
                                        <div class="relative">
                                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> <i data-lucide="calendar" class="w-4 h-4"></i> </div> <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="" class="form-label">อายุ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="30">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">อีเมล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="example@mail.com">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">เบอร์ติดต่อ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="089-782-4267">
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
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                        <select id="update-profile-form-8" class="form-select">
                                            <option>กมม</option>
                                            <option>กระบี่</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                        <select id="update-profile-form-8" class="form-select">
                                            <option>กมม</option>
                                            <option>กระบี่</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="" class="form-label">รหัสไปรษณีย์</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                    </div>

                                    <div class="col-span-1 md:col-span-2">
                                        <label for="update-profile-form-5" class="form-label">ที่อยู่</label>
                                        <textarea id="update-profile-form-5" class="form-control" rows="5" placeholder="Adress">10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/profile-1.jpg">
                                        <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
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
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">ประเภทสินค้า</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>อาหารคลีน</option>
                                    <option>ขนมคลีน</option>
                                    <option>เบเกอรี่</option>
                                    <option>เสื้อผ้า</option>
                                    <option>รองเท้า</option>
                                    <option>อื่นๆ</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รายละเอียดเกี่ยวกับแบรนด์และสินค้า</label>
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">วิธีการจัดเก็บสินค้า</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>Ambeint</option>
                                    <option>Chilled</option>
                                    <option>Frozen</option>
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">Shelf-life</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="" class="form-label">จำนวนรายการสินค้า (SKU)</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="" class="form-label">วันที่พร้อมส่ง</label>
                                <div class="relative">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                </div>
                            </div>

                            <div>
                                <label for="" class="form-label">ช่องทาง social media</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
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
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>กมม</option>
                                    <option>กระบี่</option>
                                </select>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>กมม</option>
                                    <option>กระบี่</option>
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">รหัสไปรษณีย์</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างรายการสินค้า</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างสินค้าและแพ็คเกจ</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รูปใบรับรองสินค้า / Certificate อื่นๆ (ถ้ามี)</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
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
                                    <label for="" class="form-label">ชื่อธนาคาร</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div>
                                    <label for="" class="form-label">ชื่อบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div>
                                    <label for="" class="form-label">เลขบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าหนังสือรับรองบริษัท</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- END: Personal Information -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content -->
</div>
@endsection

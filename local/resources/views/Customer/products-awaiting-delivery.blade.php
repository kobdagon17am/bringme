@extends('layouts.Customer.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                สินค้ารอจัดส่ง
            </h2>

            <div class="box mt-5 p-5">
                <div class="grid md:grid-cols-2 gap-5 ">
                    <div class="flex flex-col gap-5">
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">ร้านค้า :*</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">รหัสใบเสร็จ :*</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>

                    </div>

                    <div class="flex flex-col gap-5">
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">รหัส-ชื่อลูกค้า :*</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap sm:w-24 mr-5">ช่วงวันที่ออกบิล :*</label>
                            <div class="flex w-full gap-5">
                                <div class="relative w-full">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                </div>
                                <div class="relative w-full">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-5">
                            <button class="btn btn-primary"><i data-lucide="search" class="w-4 h-4 mr-2"></i> Search</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto mt-5">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap" colspan="2">เลือก</th>
                                <th class="whitespace-nowrap">วันเวลาที่ออกบิล</th>
                                <th class="whitespace-nowrap">ใบเสร็จ</th>
                                <th class="whitespace-nowrap">ชื่อลูกค้า</th>
                                <th class="whitespace-nowrap text-center">พนังงานที่ออกบิล</th>
                                <th class="whitespace-nowrap text-center">ร้านค้า</th>
                                <th class="whitespace-nowrap text-center">ใบเสร็จ</th>
                                <th class="whitespace-nowrap text-center">รวมเงิน</th>
                                <th class="whitespace-nowrap text-center">ค่าขนส่ง</th>
                                <th class="whitespace-nowrap text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td class="">
                                    <div class="form-check">
                                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                        <label class="form-check-label" for="checkbox-switch-1"></label>
                                    </div>
                                </td>
                                <td class=""></td>
                                <td class="">2023-03-20 15:05:15</td>
                                <td class="">0123032000001</td>
                                <td class="">A1000 นายจรูญ อินทนาศักดิ์</td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">ร้านค้า 1</td>
                                <td class="">
                                    <a href="javascript:;"><i data-lucide="printer" class="w-4 h-4 mx-auto "></i></a>
                                </td>
                                <td class="text-center">1990.0</td>
                                <td class="text-center">100</td>
                                <td class="text-center">-รอเบิกสินค้า-</td>
                            </tr>
                            <tr>
                                <td class="">
                                    <div class="form-check">
                                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                        <label class="form-check-label" for="checkbox-switch-1"></label>
                                    </div>
                                </td>
                                <td class=""></td>
                                <td class="">2023-03-20 15:05:15</td>
                                <td class="">0123032000002</td>
                                <td class="">A1000 นายจรูญ อินทนาศักดิ์</td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">ร้านค้า 1</td>
                                <td class="">
                                    <a href="javascript:;"><i data-lucide="printer" class="w-4 h-4 mx-auto"></i></a>
                                </td>
                                <td class="text-center">1990.0</td>
                                <td class="text-center">100</td>
                                <td class="text-center">-รอเบิกสินค้า-</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-left">
                                        </i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                                <li class="page-item">
                                    <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
                                </li>
                            </ul>
                        </nav>
                        <select class="w-20 form-select mt-3 sm:mt-0">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                </div>
                <div class="intro-y flex justify-center">
                    <button class="btn btn-primary"><i data-lucide="archive" class="w-4 h-4 mr-2"></i> สร้าง Packing List</button>
                </div>
            </div>

            <div class="box p-5 mt-5">
                <h2 class="intro-y text-md font-medium ">
                    รายการ Packing List
                </h2>
                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible mt-5">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">รหัสนำส่ง</th>
                                <th class="whitespace-nowrap">ใบเสร็จ</th>
                                <th class="whitespace-nowrap">ผู้ออกบิล</th>
                                <th class="whitespace-nowrap">การจัดส่ง</th>
                                <th class="whitespace-nowrap">ชื่อลูกค้าตามใบเสร็จ</th>
                                <th class="whitespace-nowrap">ที่อยู่จัดส่ง</th>
                                <th class="whitespace-nowrap">สถานะ</th>
                                <th class="whitespace-nowrap"></th>
                                <th class="text-center whitespace-nowrap">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="intro-x whitespace-nowrap">
                                <td class="">P106349</td>
                                <td class="">0123032000001<br />0123032000002</td>
                                <td class="">Admin</td>
                                <td class="text-center">22001</td>
                                <td class="text-center">นายจรูญ อินทนาศักดิ์<br />นายจรูญ อินทนาศักดิ์</td>
                                <td class="text-center">
                                    นายจรูญ อินทนาศักดิ์ (ตย.) 2102/1 อาคารไอยเรศวร หมู่.4 ซ.ลาดพร้าว 84<br />
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="javascript:;" class="text-primary">[แก้ไขที่อยู่]</a>
                                        <a href="javascript:;" class="text-primary">[0123032000001]</a>
                                    </div>
                                </td>
                                <td class="text-center">-รอเบิกสินค้าจากคลัง-</td>
                                <td class="text-center">
                                    <button class="btn btn-primary">ยืนยัน</button>
                                </td>
                                <td class="table-report__action">
                                    <a class="btn btn-danger" href="#">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="intro-x whitespace-nowrap">
                                <td class="">P106349</td>
                                <td class="">0123032000001</td>
                                <td class="">Admin</td>
                                <td class="text-center">22001</td>
                                <td class="text-center">นายจรูญ อินทนาศักดิ์</td>
                                <td class="text-center">
                                    นายจรูญ อินทนาศักดิ์ (ตย.) 2102/1 อาคารไอยเรศวร หมู่.4 ซ.ลาดพร้าว 84<br />
                                </td>
                                <td class="text-center">-รอเบิกสินค้าจากคลัง-</td>
                                <td class="text-center">
                                    <div class="font-bold text-primary">ยืนยันแล้ว</div>
                                    โดย : Admin 2020-03-12 18:11:51
                                </td>
                                <td class="table-report__action">
                                    <a class="btn btn-danger" href="#">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: Data List -->
                <!-- BEGIN: Pagination -->
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
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
                                <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
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
                <!-- END: Pagination -->
            </div>
            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3">
                                </i>
                                <div class="text-3xl mt-5">Are you sure?</div>
                                <div class="text-slate-500 mt-2">
                                    Do you really want to delete these records?
                                    <br>
                                    This process cannot be undone.
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                <button type="button" class="btn btn-danger w-24">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Delete Confirmation Modal -->
        </div>
@endsection
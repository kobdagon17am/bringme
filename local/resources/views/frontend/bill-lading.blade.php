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
                            <label for="" class="form-label sm:w-24 mr-5">ร้านค้า :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">พนักงาน :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">สถานะ :</label>
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
                            <label for="" class="form-label whitespace-nowrap sm:w-24 mr-5">วันที่สร้างใบเบิก :*</label>
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
                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap sm:w-24 mr-5">วันที่จ่ายสินค้า :*</label>
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
                        <div class="flex justify-end gap-5">
                            <button class="btn btn-primary"><i data-lucide="search" class="w-4 h-4 mr-2"></i> ค้นหา</button>
                            <button class="btn btn-success text-white"> รายการจ่ายวันนี้</button>
                            <button class="btn btn-success text-white"> รายการจ่ายย้อนหลัง 30 วัน</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto mt-5">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">รหัสใบเบิก</th>
                                <th class="whitespace-nowrap">วันที่สร้างใบเบิก</th>
                                <th class="whitespace-nowrap">จำนวนใบเสร็จ</th>
                                <th class="whitespace-nowrap">ผู้สร้างใบเบิก</th>
                                <th class="whitespace-nowrap text-center">ผู้อนุมัติเบิก</th>
                                <th class="whitespace-nowrap text-center">ผู้จัดส่ง</th>
                                <th class="whitespace-nowrap text-center">สถานะ</th>
                                <th class="whitespace-nowrap text-center">ค้างจ่าย</th>
                                <th class="whitespace-nowrap text-center">Tools</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td class="">P200527</td>
                                <td class="">2023-03-20</td>
                                <td class="">2</td>
                                <td class="">Admin</td>
                                <td class="">-</td>
                                <td class="text-center">-</td>
                                <td class="text-center">รอเบิก</td>
                                <td class=""></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary"><i data-lucide="printer" class="w-4 h-4 mr-2"></i> รายละเอียด</a>
                                    <a href="#" class="btn btn-primary"><i data-lucide="printer" class="w-4 h-4 mr-2"></i> ใบเสร็จ</a>
                                    <a href="pick-warehouse.php" class="btn btn-pending"><i data-lucide="edit" class="w-4 h-4 mr-2"></i> อนุมัติเบิก</a>
                                    <a href="pick-warehouse-delivery.php" class="btn btn-secondary"><i data-lucide="file-text" class="w-4 h-4 mr-2"></i> จัดส่ง</a>
                                </td>
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

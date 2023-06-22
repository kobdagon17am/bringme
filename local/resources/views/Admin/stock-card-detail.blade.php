@extends('layouts.Admin.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                STOCK CARD/1001:AIMMURA
            </h2>

            <div class="box p-5 mt-5">
                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible mt-5">
                    <div class="flex gap-5 ">

                        <div class="form-inline">
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

                        <button class="btn btn-primary"><i data-lucide="settings" class="w-4 h-4 mr-2"></i> ประมวลผล/Processing</button>

                    </div>
                    <table class="table table-bordered table-hover mt-5">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Row(s)</th>
                                <th class="whitespace-nowrap">Date:Processing</th>
                                <th class="whitespace-nowrap">Item Type</th>
                                <th class="whitespace-nowrap">Reference Code</th>
                                <th class="whitespace-nowrap">Operator</th>
                                <th class="whitespace-nowrap text-center">Approval</th>
                                <th class="whitespace-nowrap text-center">รับเข้า</th>
                                <th class="whitespace-nowrap text-center">จ่ายออก</th>
                                <th class="whitespace-nowrap text-center">ยอดคงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td class="">1</td>
                                <td class="">2023-03-20 15:05:15</td>
                                <td class="text-center">รับสินค้าเข้าทั่วไป</td>
                                <td class="">REF113230320418</td>
                                <td class="">Admin</td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">100</td>
                                <td class="text-center"></td>
                                <td class="text-center">100</td>
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
                    <select class="w-20 form-select mt-3 sm:mt-0">
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

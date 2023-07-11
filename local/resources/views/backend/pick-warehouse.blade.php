

@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                เบิกจ่ายสินค้าจากคลัง
            </h2>

            <div class="box mt-5 p-5">
                <h2 class="intro-y text-md font-medium">
                    ใบเสร็จรอจัดเบิกจากคลัง
                </h2>
                <div class="intro-y  overflow-x-auto mt-5">
                    <table class="table table-bordered table-hover">
                        <thead class="whitespace-nowrap text-center">
                            <tr>
                                <th class="">เลือก</th>
                                <th class="">รหัสใบเบิก</th>
                                <th class="">ใบเสร็จ</th>
                                <th class="">พนักงานที่ดำเนินการ</th>
                                <th class="">สถานะการเบิก</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap text-center">
                            <tr>
                                <td class="">527</td>
                                <td class="">P200527</td>
                                <td class="">
                                    0123032000001<br />
                                    0123032000002
                                </td>
                                <td class="">Admin</td>
                                <td class="text-center">-รอจัดเบิก-</td>
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

            <div class="box mt-5 p-5">
                <h2 class="intro-y text-md font-medium">
                    รายการสินค้าที่รอหยิบออกจากคลัง (FIFO)
                </h2>
                <div class="intro-y overflow-x-auto mt-5">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap" colspan="3">รายการครั้งที่จ่าย</th>
                                <th class="whitespace-nowrap" colspan="6">รายการสินค้า</th>
                            </tr>
                            <tr>
                                <th class="whitespace-nowrap">ครั้งที่</th>
                                <th class="whitespace-nowrap">วันที่จ่าย</th>
                                <th class="whitespace-nowrap">พนักงาน</th>
                                <th class="whitespace-nowrap">ชื่อสินค้า</th>
                                <th class="whitespace-nowrap">จ่ายครั้งนี้</th>
                                <th class="whitespace-nowrap">ค้างจ่าย</th>
                                <th class="whitespace-nowrap">หยิบสินค้าจากคลัง</th>
                                <th class="whitespace-nowrap">Lot number [Expired]</th>
                                <th class="whitespace-nowrap">จำนวน</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td class="">-</td>
                                <td class="">-</td>
                                <td class="">-</td>
                                <td class="">
                                    <div class="font-bold">1005: 7 ACTIVE</div>
                                    <a href="javascript:;" class="text-primary">(0123032000001)</a>
                                </td>
                                <td class="text-center">1</td>
                                <td class="text-center">0</td>
                                <td class="text-center">คลัง2/Zone-1/Shelf-1/ชั้น 1</td>
                                <td class="text-center">1231234433 [2023-04-08]</td>
                                <td class="text-center">1</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="intro-y flex justify-center mt-5">
                        <button class="btn btn-primary">ผู้อนุมัติเบิกสินค้า</button>
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


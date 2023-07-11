@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                ตรวจสอบสต็อก
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
                            <label for="" class="form-label sm:w-24 mr-5">คลัง :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">Zone :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">Shelf :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">ชั้น :</label>
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
                            <label for="" class="form-label sm:w-24 mr-5">สินค้า :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">Lot-No. :</label>
                            <select class="form-control">
                                <option selected>Select</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label for="" class="form-label sm:w-24 mr-5">แสดง Lot ยอดเป็น 0 :</label>
                            <select class="form-control">
                                <option selected>ไม่แสดง</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>

                        <div class="flex justify-end mt-5">
                            <button class="btn btn-primary"><i data-lucide="search" class="w-4 h-4 mr-2"></i> ค้นหา</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto mt-5">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">No.</th>
                                <th class="whitespace-nowrap">รหัสสินค้า:ชื่อสินค้า</th>
                                <th class="whitespace-nowrap">ล็อตนัมเบอร์</th>
                                <th class="whitespace-nowrap">วันหมดอายุ</th>
                                <th class="whitespace-nowrap text-center">จำนวน</th>
                                <th class="whitespace-nowrap text-center">คลังสินค้า</th>
                                <th class="whitespace-nowrap text-center">STOCK CARD</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td>1</td>
                                <td>1001:AIMMURA</td>
                                <td>2321312312</td>
                                <td>2023-03-31</td>
                                <td>99</td>
                                <td>(1769) Zone-1/Shelf-1/ชั้น-1</td>
                                <td><a href="stock-card-detail.php" class="btn btn-outline-primary">STOCK CARD (1764)</a></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Total for 1001:AIMMURA</td>
                                <td>99</td>
                                <td></td>
                                <td></td>
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

@extends('layouts.Customer.app')

@section('content')
<div class="content">
            <!-- <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form Layout
                    </h2>
                </div> -->
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <!-- END: Profile Menu -->
                <div class="col-span-12">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex flex-col gap-5 p-5">
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">ร้านค้า :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">สาเหตุที่รับเข้า :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">สภาพสินค้าที่รับเข้า :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">เลขที่อ้างอิงใบยืม(กรณีรับคืนจากการยืม) :</label>
                                <input id="" type="text" class="form-control">
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">ผู้ส่งมอบ :*</label>
                                <input id="" type="text" class="form-control">
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">รหัสสินค้า:ชื่อสินค้า :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">อายุการเก็บรักษา :*</label>
                                <input id="" type="text" class="form-control">
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">จำนวน :*</label>
                                <input id="" type="text" class="form-control">
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">หน่วยนับ :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">คลัง :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">Zone :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">Shelf :*</label>
                                <select class="form-control">
                                    <option selected>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">รับเข้าชั้นของ Shelf :</label>
                                <input id="" type="text" class="form-control">
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">ผู้ดำเนินการ(User Login) :</label>
                                <input id="" type="text" class="form-control" value="Admin" readonly>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">ผู้อนุมัติ(Admin Login) :</label>
                                <input id="" type="text" class="form-control" value="Admin" readonly>
                            </div>
                            <div class="form-inline">
                                <label for="" class="form-label sm:w-60 mr-5">อนุมัติ :</label>
                                <div class="form-check form-switch">
                                    <input id="checkbox-switch-7" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="checkbox-switch-7">อนุมัติ/Aproved</label>
                                </div>
                            </div>

                            <div class="text-right mt-5">
                                <a href="receive-product.php" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</a>
                                <button type="button" class="btn btn-primary w-24">บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <!-- END: Display Information -->
                </div>
            </div>
        </div>
@endsection

@extends('layouts.backend.app')

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
                            @foreach ($order as $item)
                            <tr>
                                <td class="">{{date('Y/m/d H:i:s',strtotime($item->created_at))}}</td>
                                <td class="">{{$item->order_number}}</td>
                                <td class="">{{$item->customer_name}}</td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">ร้านค้า 1</td>
                                <td class="">
                                    <a href="javascript:;"><i data-lucide="printer" class="w-4 h-4 mx-auto "></i></a>
                                </td>
                                <td class="text-center">{{$item->total_price}}</td>
                                <td class="text-center">{{$item->shipping_price}}</td>
                                <td class="text-center">-สินค้ารอจัดส่ง-</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
                {{-- <div class="intro-y flex justify-center">
                    <button class="btn btn-primary"><i data-lucide="archive" class="w-4 h-4 mr-2"></i> สร้าง Packing List</button>
                </div> --}}
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

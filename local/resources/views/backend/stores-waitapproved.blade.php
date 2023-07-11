@extends('layouts.backend.app')

@section('content')
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            รายการร้านค้ายังไม่อนุมัติ
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">



                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">รูปภาพ</th>
                            <th class="whitespace-nowrap">ชื่อร้านค้า</th>
                            <th class="text-center whitespace-nowrap">ชื่อเจ้าของร้าน</th>
                            <th class="text-center whitespace-nowrap">สถานะ</th>
                            <th class="text-center whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $customer = DB::table('customer')
                            ->where('customer_type', 2)
                            ->where('approve_store', 0)

                            ->get();

                        ?>

                        @foreach ($customer as $value)
                            <tr class="intro-x">
                                <td class="w-40">
                                    <div class="flex">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone - HTML Admin Template" class=" rounded-full"
                                                src="{{ asset('backend/dist/images/preview-9.jpg') }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="font-medium whitespace-nowrap">{{ $value->name }}</a>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $name_full = $value->firstname . ' ' . $value->lat;
                                    ?>
                                    {{ $name_full }}</td>
                                <td class="w-40">
                                    <?php
                                    if ($value->approve_store == 1) {
                                        $htmml = '<div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>';
                                    } elseif ($value->approve_store == 2) {
                                        $htmml = '<div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Not Active </div>';
                                    } else {
                                        $htmml = '<div class="flex items-center justify-center text-warning"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> รออนุมัติ </div>';
                                    }
                                    ?>
                                    {{-- <a href="#!"  onclick="confirmation_customer({{ $value->id }})">{!! $htmml !!}</a> --}}

                                <a  href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview_{{$value->id}}">{!! $htmml !!}</a>

                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{ route('admin/store-detail') }}"><i
                                                data-lucide="eye" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
                                    </div>
                                </td>



                                <div id="header-footer-modal-preview_{{$value->id}}" class="modal" tabindex="-1" aria-hidden="true">
                                    <form method="POST" action="{{ route('admin/stores_confirmation') }}" >
                                                        @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- BEGIN: Modal Header -->
                                            <div class="modal-header">
                                                <h2 class="font-medium text-base mr-auto">อนุมัติร้านค้า</h2>

                                            </div> <!-- END: Modal Header -->
                                            <!-- BEGIN: Modal Body -->
                                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                <div class="col-span-12 sm:col-span-12"> <label for="modal-form-1" class="form-label">ชื่อร้านค้า</label>
                                                    <input id="modal-form-1" type="text" class="form-control" value="{{ $value->name }}" disabled>
                                                </div>
                                                <div class="col-span-12 sm:col-span-12"> <label for="modal-form-2" class="form-label">ชื่อเจ้าของร้าน</label>
                                                    <input id="modal-form-2" type="text" class="form-control" value="{{$name_full}}" disabled>
                                                </div>
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <div class="col-span-12 sm:col-span-6"> <label for="modal-form-6" class="form-label">สถานะการลงทะเบัยน</label>
                                                    <select id="modal-form-6" class="form-select" name="status">
                                                        <option value="1">อนุมัติ</option>
                                                        <option value="2">ไม่อนุมัติ</option>

                                                    </select> </div>

                                                <div class="col-span-12 sm:col-span-12"> <label for="modal-form-5" class="form-label">รายละเอียด
                                                </label> <textarea id="modal-form-5" type="text" class="form-control" name="note"> </textarea></div>

                                            </div> <!-- END: Modal Body -->
                                            <!-- BEGIN: Modal Footer -->
                                            <div class="modal-footer"> <button type="button" data-tw-dismiss="modal"
                                                    class="btn btn-outline-secondary w-20 mr-1">ยกเลิก</button>
                                                    <button type="submit"
                                                    class="btn btn-primary w-20">ยืนยัน</button> </div> <!-- END: Modal Footer -->
                                        </div>
                                    </div>
                                    </form>
                                </div> <!-- END: Modal Content -->
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->

            <!-- END: Pagination -->
        </div>

    </div>



@endsection
@section('js')
    <script type="text/javascript">
        function confirmation_customer(id) {
            $("#header-footer-modal-preview").show();

            // $.ajax({
            //         url: '',
            //         type: 'GET',
            //         data: {
            //             id
            //         }
            //     })
            //     .done(function(data) {

            //         $("#-modal").modal();
            //         $("#id").val(data['data']['id']);

            //         $("#unit_name").val(data['data']['product_unit_th']);
            //         $("#unit_en_name").val(data['data']['product_unit_en']);
            //         $("#unit_status").val(data['data']['status']);

            //     })
            //     .fail(function() {
            //         console.log("error");
            //     })
        }
    @endsection

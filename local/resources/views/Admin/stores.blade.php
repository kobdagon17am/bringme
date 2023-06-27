@extends('layouts.Admin.app')
<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        ข้อมูลร้านค้า
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">



         <table class="table table-report -mt-2" id="ex">
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
                    ->where('customer_type',2)
                    ->where('approve_store',1)
                    ->get();

                    ?>

                    @foreach ($customer as $value)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Midone - HTML Admin Template" class=" rounded-full" src="{{asset('admin_st/dist/images/preview-9.jpg')}}">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{$value->name}}</a>
                        </td>
                        <td class="text-center">
                            <?php
                                 $name_full = $value->firstname.' '.$value->lat;
                                ?>
                            {{$name_full}}</td>
                        <td class="w-40">
                            <?php
                                if($value->approve_store == 1){
                                    $htmml = '<div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>' ;

                                    }elseif($value->approve_store == 2){
                                    $htmml =  '<div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Not Active </div>';

                                    }else{
                                        $htmml =  '<div class="flex items-center justify-center text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Paning </div>';;

                                    }
                            ?>
                           {!!$htmml!!}
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{route('admin/store-detail')}}"><i data-lucide="eye" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
                            </div>
                        </td>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
        $(function() {
            table_order = $('#ex').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel'],
                searching: false,
                ordering: false,
                lengthChange: false,
                responsive: true,
                paging: false,
                processing: true,
                serverSide: true,
                "language": {
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "แสดงหน้า _PAGE_ จาก _PAGES_ หน้า",
                    "search": "ค้นหา",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "paginate": {
                        "first": "หน้าแรก",
                        "previous": "ย้อนกลับ",
                        "next": "ถัดไป",
                        "last": "หน้าสุดท้าย"
                    },
                    'processing': "กำลังโหลดข้อมูล",
                },
                ajax: {
                    url: '{{ route('admin/stores_datable') }}',
                    data: function(d) {
                    d.user_name = $('#user_name').val();
                    d.s_date = $('#s_date').val();
                    d.e_date = $('#e_date').val();
                    // d.position = $('#position').val();
                    // d.type = $('#type').val();

                    },
                },


                columns: [
                    // {
                    //     data: "id",
                    //     title: "ลำดับ",
                    //     className: "w-10 text-center",
                    // },
                    {
                        data: "img",
                        title: "รูปภาพ",
                        className: "w-10",
                    },
                    {
                        data: "name",
                        title: "ชื่อร้านค้า",
                        className: "w-10",
                    },

                    {
                        data: "name_full",
                        title: "ชื่อเจ้าของร้าน",
                        className: "w-10",
                    },

                    {
                        data: "status",
                        title: "สถานะ",
                        className: "w-10",
                    },

                    {
                        data: "action",
                        title: "action",
                        className: "w-10",

                    },



                ],



            });
            $('#search-form').on('click', function(e) {
            table_order.draw();
            e.preventDefault();
        });

        });
    </script>
    @endsection

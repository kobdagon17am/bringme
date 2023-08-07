@extends('layouts.backend.app')

@section('content')
<div class="content">
                <h2 class="intro-y text-lg font-medium mt-10">
                    ข้อมูลลูกค้า
                </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">


                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-striped table-hover dt-responsive -mt-2" id="workL">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">รูปภาพ</th>
                                    <th class="whitespace-nowrap">ชื่อ-นามสกุล</th>
                                    <th class="text-center whitespace-nowrap">อีเมล</th>
                                    <th class="text-center whitespace-nowrap">เบอร์โทรศัพท์</th>
                                    <th class="text-center whitespace-nowrap">สถานะ</th>
                                    <th class="text-center whitespace-nowrap"></th>
                                </tr>
                            </thead>

                        </table>
                        {{-- <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">รูป</th>
                                    <th class="whitespace-nowrap">ชื่อ-นามสกุล</th>
                                    <th class="text-center whitespace-nowrap">อีเมล</th>
                                    <th class="text-center whitespace-nowrap">เบอร์โทรศัพท์</th>
                                    <th class="text-center whitespace-nowrap">สถานะ</th>
                                    <th class="text-center whitespace-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="intro-x">
                                    <td class="w-40">
                                        <div class="flex">
                                            <div class="w-10 h-10 image-fit zoom-in">
                                                <img alt="Midone - HTML Admin Template" class=" rounded-full" src="dist/images/preview-9.jpg">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="" class="font-medium whitespace-nowrap">วีรพล อุดมทรัพย์</a>
                                    </td>
                                    <td class="text-center">example@mail.com</td>
                                    <td class="text-center">089-998-8899</td>
                                    <td class="w-40">
                                    <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> กำลังใช้งาน </div>
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="user-edit.php"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i>  แก้ไข </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>

                </div>

                <!-- END: Delete Confirmation Modal -->
            </div>
@endsection

@section('js')
<script type="text/javascript">

    $(function() {


        table_order = $('#workL').DataTable({
            // dom: 'Bfrtip',
            // buttons: ['excel'],
            searching: true,
            ordering: false,
            lengthChange: false,
            responsive: true,
            paging: true,
            pageLength: 100,
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
                url: '{{ route('admin/customers_datable') }}',
                data: function(d) {
                // d.user_name = $('#user_name').val();
                // d.s_date = $('#s_date').val();
                // d.e_date = $('#e_date').val();
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
                    // title: 'รูปภาพ',
                    className: "w-10 text-center",



                },
                // {
                //     data: "name",
                //     //title: "ชื่อร้านค้า",
                //     className: "w-10",
                // },

                {
                    data: "name_full",
                    //title: "ชื่อเจ้าของร้าน",
                    className: "w-10",
                },

                {
                    data: "email",
                    //title: "ชื่อเจ้าของร้าน",
                    className: "w-10",
                },

                {
                    data: "tel",
                    //title: "ชื่อเจ้าของร้าน",
                    className: "w-10",
                },

                {
                    data: "status",
                    title: "สถานะ",
                    className: "w-10 text-center",
                },

                {
                    data: "action",
                    // title: "action",
                    className: "w-5 ",

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

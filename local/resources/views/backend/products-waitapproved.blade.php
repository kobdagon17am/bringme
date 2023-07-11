@extends('layouts.backend.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        รายการสินค้ายังไม่อนุมัติ
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="table-responsive">
                <table id="workL" class="table table-striped table-hover dt-responsive display nowrap">

                </table>

            </div>


        </div>
        <!-- BEGIN: Data List -->
        {{-- <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">รูป</th>
                        <th class="whitespace-nowrap">ชื่อสินค้า</th>
                        <th class="text-center whitespace-nowrap">ชื่อร้านค้า</th>
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
                            <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                        </td>
                        <td class="text-center">ร้านค้า 1</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="products-waitapproved-detail.php"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-10.jpg">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">Nike Air Max 270</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Sport &amp; Outdoor</div>
                        </td>
                        <td class="text-center">ร้านค้า 1</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="products-waitapproved-detail.php"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-5.jpg">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">Nikon Z6</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Photography</div>
                        </td>
                        <td class="text-center">ร้านค้า 2</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="products-waitapproved-detail.php"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i> รายละเอียด </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}

    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x-circle" data-lucide="x-circle" class="lucide lucide-x-circle w-16 h-16 text-danger mx-auto mt-3">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
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
                url: '{{ route('admin/products_waitapproved_datable') }}',
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
                    title: 'รูปภาพ',
                    className: "w-10 text-center",



                },
                {
                    data: "product_name",
                    title: "ชื่อสินค้า",
                    className: "w-10",
                },

                {
                    data: "stor_name",
                    title: "ชื่อร้านค้า",
                    className: "w-10",
                },

                {
                    data: "qty",
                    title: "จำนวน",
                    className: "w-10",
                },

                // {
                //     data: "display_status",
                //     title: "สถานะ",
                //     className: "w-10 text-center",
                // },

                {
                    data: "action",
                    title: "",
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

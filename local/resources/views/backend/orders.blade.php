@extends('layouts.backend.app')

@section('content')
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            ข้อมูลการสั่งซื้อ
        </h2>

        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">

                <div class="flex w-full sm:w-auto">
                    <div class="w-48 relative text-slate-500">
                        <input type="text" class="form-control w-48 box pr-10" placeholder="ค้นหา...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                    <select class="form-select box ml-2">
                        <option>สถานะ</option>
                        <option>รอชำระเงิน</option>
                        <option>ยืนยัน</option>
                        <option>บรรจุ</option>
                        <option>ส่ง</option>
                        <option>สำเร็จ</option>
                    </select>
                </div>
            </div>

            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <div class="table-responsive">
                    <table id="workL" class="table table-striped table-hover dt-responsive display nowrap">

                    </table>

                </div>
            </div>


        </div>


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
                url: '{{ route('admin/order_datable') }}',
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
                    data: "order_number",
                    title: 'หมายเลขออเดอร์',
                    className: "w-10 text-center",



                },
                {
                    data: "cus_name",
                    title: "ชื่อผู้ซื้อ",
                    className: "w-10",
                },

                {
                    data: "picking_status",
                    title: "หยิบสินค้า",
                    className: "w-10",
                },

                {
                    data: "scan_status",
                    title: "สแกนสินค้า",
                    className: "w-10",
                },

                {
                    data: "transfer_status",
                    title: "จัดส่งสินค้า",
                    className: "w-10 text-center",
                },

                {
                    data: "transfer",
                    title: "การชำระเงิน",
                    className: "w-10 text-center",
                },

                {
                    data: "grand_total",
                    title: "ราคารวม",
                    className: "w-5 ",

                },
                {
                    data: "action",
                    title: "#",
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


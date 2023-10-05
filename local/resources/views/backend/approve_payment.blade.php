@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                ข้อมูลขอถอนเงิน
            </h2>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                    <table class="table table-striped table-hover dt-responsive -mt-2" id="workL">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">ชื่อผู้ถอน</th>
                                <th class="whitespace-nowrap">ยอดถอน</th>
                                <th class="text-center whitespace-nowrap">สถานะ</th>
                                <th class="text-center whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    </table>
                </div>
                <!-- END: Data List -->
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
            url: '{{ url("admin/approve_payment_datatable") }}',
            data: function(d) {
            },
        },

        columns: [
            {
                // Use null as the data source for the auto-incremented column
                data: null,
                className: "w-10",
            },
            {
                data: "store_id",
                //title: "ชื่อเจ้าของร้าน",
                className: "w-10",
            },
            {
                data: "price",
                //title: "ชื่อเจ้าของร้าน",
                className: "w-10",
            },
            {
                data: "status",
                //title: "ชื่อเจ้าของร้าน",
                className: "w-10",
            },
            {
                data: "action",
                // title: "action",
                className: "w-5 ",

            },
        ],

        rowCallback: function(row, data, index) {
            // Get the DataTables API
            var api = this.api();

            // Set the auto-incremented column value (starting from 1)
            $('td:eq(0)', row).html(api.page.info().start + index + 1);
        },

    });

    $('#search-form').on('click', function(e) {
    table_order.draw();
    e.preventDefault();
});

});
</script>
@endsection
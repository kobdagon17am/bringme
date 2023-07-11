@extends('layouts.backend.app')

@section('content')
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            รายการร้านค้ายังไม่อนุมัติ
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">




                <table class="table table-striped table-hover dt-responsive -mt-2" id="workL">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">รูปภาพ</th>
                            <th class="whitespace-nowrap">ชื่อร้านค้า</th>
                            <th class="text-center whitespace-nowrap">ชื่อเจ้าของร้าน</th>
                            <th class="text-center whitespace-nowrap">สถานะ</th>
                            <th class="text-center whitespace-nowrap"></th>
                        </tr>
                    </thead>

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
            url: '{{ route('admin/stores_waitapproved_datable') }}',
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
            {
                data: "name",
                //title: "ชื่อร้านค้า",
                className: "w-10",
            },

            {
                data: "name_full",
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

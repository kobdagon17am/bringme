@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                ข้อมูลขอคืนเงิน
            </h2>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                    <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
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
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                    <table class="table table-striped table-hover dt-responsive -mt-2" id="workL">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">หมายเลขออเดอร์</th>
                                <th class="whitespace-nowrap">ชื่อผู้ซื้อ</th>
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
            url: '{{ url("admin/refund_datatable") }}',
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
                data: "customer_cart_id",
                //title: "ชื่อเจ้าของร้าน",
                className: "w-10",
            },
            {
                data: "customer_id",
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
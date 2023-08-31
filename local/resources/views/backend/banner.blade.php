@extends('layouts.backend.app')

@section('content')
<div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                ข้อมูลแบนเนอร์หน้าแรก
            </h2>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    <a href="{{route('admin/setting-banner-add')}}" class="btn btn-primary shadow-md mr-2">เพิ่มแบนเนอร์ใหม่</a>
                    <div class="dropdown">
                        <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                            <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="plus" class="lucide lucide-plus w-4 h-4" data-lucide="plus">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg> </span>
                        </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="printer" data-lucide="printer" class="lucide lucide-printer w-4 h-4 mr-2">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg> Print </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2">
                                            <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <line x1="10" y1="9" x2="8" y2="9"></line>
                                        </svg> Export to Excel </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2">
                                            <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <line x1="10" y1="9" x2="8" y2="9"></line>
                                        </svg> Export to PDF </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-56 relative text-slate-500">
                            <input type="text" class="form-control w-56 box pr-10" placeholder="ค้นหา...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                    </div>
                </div>
                

                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-striped table-hover dt-responsive -mt-2" id="workL">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">ภาพ</th>
                                <th class="whitespace-nowrap">ชื่อแบนเนอร์ (TH)</th>
                                <th class="whitespace-nowrap">ชื่อแบนเนอร์ (EN)</th>
                                <th class="text-center whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
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
                url: '{{ url("admin/setting-banner_datatable") }}',
                data: function(d) {
                },
            },

            columns: [
                {
                    data: "img",
                    className: "w-10",
                },
                {
                    data: "name_th",
                    className: "w-10",
                },
                {
                    data: "name_en",
                    className: "w-10",
                },
                {
                    data: "action",
                    className: "w-5 ",

                },
            ],

        });

        $('#workL').on('click', '.delete-banner', function() {
            var url = $(this).attr('url');
            Swal.fire({
              title: 'Are you sure?',
              html: "Do you really want to delete these records?<br>This process cannot be undone.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Delete',
              reverseButtons: true,
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                window.location.href = url;
              }
            })
        });

        $('#search-form').on('click', function(e) {
            table_order.draw();
            e.preventDefault();

        });

    });

    </script>
    @endsection

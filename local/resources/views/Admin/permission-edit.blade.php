@extends('layouts.Admin.app')

@section('content')
<div class="content">
            <!-- <h2 class="intro-y text-lg font-medium mt-10">
                ข้อมูลสิทธิ์การใช้งาน
            </h2> -->
            <div class="grid grid-cols-12 gap-6 mt-5">
                <!-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    <a href="permission-add.php" class="btn btn-primary shadow-md mr-2">เพิ่มสิทธิ์การใช้งาน</a>
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
                </div> -->
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="box p-5">

                        <label for="update-permission-1" class="form-label">ชื่อสิทธิ์</label>
                        <input id="update-permission-1" type="text" class="form-control" value="ผู้ดูแลระบบ">
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table mt-10">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">PAGE</th>
                                        <th class="text-center whitespace-nowrap">VIEW</th>
                                        <th class="text-center whitespace-nowrap">ADD</th>
                                        <th class="text-center whitespace-nowrap">EDIT / UPDATE</th>
                                        <th class="text-center whitespace-nowrap">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="intro-x">
                                        <td class="">Dashboard</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการพนักงาน</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการลูกค้า</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการร้านค้า</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการสิทธิ์การใช้งาน</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการสินค้า</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการฝากขาย</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการการสั่งซื้อ</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการขอคืนเงิน</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการโปรโมชั่น</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">รายการรายได้ร้านค้า</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                    <tr class="intro-x">
                                        <td class="">จัดการข้อมูลแสดงผลแอพพลิเคชั่น</td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" checked></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-5">
                            <button type="button" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</button>
                            <button type="button" class="btn btn-primary w-24">บันทึก</button>
                        </div>
                    </div>
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

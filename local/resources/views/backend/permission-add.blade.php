@extends('layouts.backend.app')

@section('content')

<div class="content">
    <form method="POST" action="{{ url('admin/permission-create') }}"  class="grid grid-cols-12 gap-6 mt-5">
        @csrf()
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="box p-5">

                <label for="update-profile-form-1" class="form-label">ชื่อสิทธิ์</label>
                <input id="update-profile-form-1" type="text" class="form-control" name="permission_name">
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
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_home]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_home]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_home]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_home]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">พนักงาน</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_employee]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_employee]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_employee]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_employee]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">ลูกค้า</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_users]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_users]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_users]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_users]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">ร้านค้า</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_stores]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_stores]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_stores]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_stores]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการสิทธิ์การใช้งาน</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_permission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_permission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_permission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_permission]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการสินค้า</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_product]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_product]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_product]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_product]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการฝากขาย</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_product_consignment]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_product_consignment]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_product_consignment]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_product_consignment]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการการสั่งซื้อ</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_orders]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_orders]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_orders]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_orders]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการขอคืนเงิน</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_refund]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_refund]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_refund]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_refund]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการโปรโมชั่น</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_promotion]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_promotion]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_promotion]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_promotion]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">รายการรายได้ร้านค้า</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_commission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_commission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_commission]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_commission]"></div>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="">จัดการข้อมูลแสดงผลแอพพลิเคชั่น</td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_view[admin_setting]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_add[admin_setting]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_edit[admin_setting]"></div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch justify-center"> <input id="checkbox-switch-7" class="form-check-input" type="checkbox" name="permission_delete[admin_setting]"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
        <!-- </form> -->
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

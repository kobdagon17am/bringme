@extends('layouts.backend.app')

@section('content')
<div class="content">
    <!-- <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form Layout
                    </h2>
                </div> -->
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <!-- END: Profile Menu -->
        <div class="col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="p-5">
                    <div class="flex xl:flex-row flex-col gap-6">
                        <div class="w-52 mx-auto">
                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                    <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('frontend/dist/images/profile-1.jpg') }}">
                                    <!-- <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div> -->
                                </div>
                                <!-- <div class="mx-auto cursor-pointer relative mt-5"> -->
                                    <!-- <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button> -->
                                    <!-- <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0"> -->
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="flex-1 mt-6 xl:mt-0">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 2xl:col-span-6">
                                    <div>
                                        <label for="update-profile-form-1" class="form-label">ชื่อผู้ใช้</label>
                                        <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{ (!empty($customer) ? $customer->name : '') }}">
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-2" class="form-label">เบอร์โทรศัพท์</label>
                                        <input id="update-profile-form-2" type="text" class="form-control" placeholder="Input text" value="{{ (!empty($customer) ? $customer->tel : '') }}">
                                    </div>
                                </div>
<!-- 
                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-2" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                                        <input id="update-profile-form-2" type="text" class="form-control" value="{{ (!empty($customer) ? $customer->idcard : '') }}">
                                    </div>
                                </div> -->

                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-3" class="form-label">อีเมล</label>
                                        <input id="update-profile-form-3" type="email" class="form-control" placeholder="Input text" value="{{ (!empty($customer) ? $customer->email : '') }}">
                                    </div>
                                </div>
                                <!-- <div class="col-span-12 2xl:col-span-6">
                                    <label for="update-profile-form-4" class="form-label">รหัสผ่าน</label>
                                    <input id="update-profile-form-4" type="password" class="form-control" placeholder="Input text" value="">
                                </div> -->

                                <div class="col-span-12 2xl:col-span-6">
                                    <label for="update-profile-form-4" class="form-label">วันเกิด</label>
                                    <input id="update-profile-form-4" type="date" class="form-control" placeholder="Input Birthday" value="{{ (!empty($customer) ? date('Y-m-d', strtotime(str_replace('/','-',$customer->birthday))) : '') }}">
                                </div>

                                <?php 
                                    $show_address = null;
                                    if(!empty($address)){
                                        foreach ($address as $key => $_address) {
                                            $key += 1;
                                            $show_address = $_address->address_number.' '.$_address->provinces_name.' '.$_address->amphures_name.' '.$_address->districts_name.' '.$_address->zipcode;
                                            echo '<div class="col-span-12">
                                                    <div class="">
                                                        <label for="update-profile-form-5" class="form-label">ที่อยู่ '.$key.'</label>
                                                        <textarea id="update-profile-form-5" class="form-control" rows="5" placeholder="Adress">'.$show_address.'</textarea>
                                                    </div>
                                                </div>';
                                        }
                                    }
                                ?>
                                

                            </div>
                            <div class="text-right mt-5">
                                <a href="{{ url('admin/users') }}" class="btn btn-outline-secondary w-24 mr-1">ย้อนกลับ</a>
                                @if($customer->approve_store == '1')
                                <button type="button" class="btn btn-danger w-50 block_user" ref="{{ $customer->id }}">บล็อกบัญชี</button>
                                @elseif($customer->approve_store == '2')
                                <button type="button" class="btn btn-warning w-50 unblock_user" ref="{{ $customer->id }}">ปลดบล็อกบัญชี</button>
                                @else
                                <button type="button" class="btn btn-success w-50 approve_user" ref="{{ $customer->id }}">อนุมัติบัญชี</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('.block_user').click(function(){
        var customer_id = $(this).attr('ref');
        Swal.fire({
          title: 'ยืนยันการบล็อก ?',
          text: "คุณต้องการบล็อกลูกค้าท่านนี้ใช่หรือไม่ ?",
          icon: 'warning',
          reverseButtons: true,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              'type': 'post', 
              'url': "{{ url('admin/block_user') }}", 
              'dataType': 'text',
              'data': { 'customer_id' : customer_id, 
                        '_token' : "{{csrf_token()}}" 
                      },
              'success': function (data){
                    Swal.fire(
                      'บล็อกบัญชีเสร็จสิ้น !',
                      'บัญชีดังกล่าวได้ถูกบล็อกเรียบร้อย.',
                      'success'
                    );
                    window.location.reload();
              }
            });
          }
        })
    });

    $('.unblock_user').click(function(){
        var customer_id = $(this).attr('ref');
        Swal.fire({
          title: 'ยืนยันการปลดบล็อก ?',
          text: "คุณต้องการปลดบล็อกลูกค้าท่านนี้ใช่หรือไม่ ?",
          icon: 'warning',
          reverseButtons: true,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              'type': 'post', 
              'url': "{{ url('admin/unblock_user') }}", 
              'dataType': 'text',
              'data': { 'customer_id' : customer_id, 
                        '_token' : "{{csrf_token()}}" 
                      },
              'success': function (data){
                    Swal.fire(
                      'ปลดบล็อกบัญชีเสร็จสิ้น !',
                      'บัญชีดังกล่าวได้ถูกปลดบล็อกเรียบร้อย.',
                      'success'
                    )
                    window.location.reload();
              }
            });
          }
        })
    });

    $('.approve_user').click(function(){
        var customer_id = $(this).attr('ref');
        Swal.fire({
          title: 'ยืนยันการอนุมัตื ?',
          text: "คุณต้องการอนุมัตืลูกค้าท่านนี้ใช่หรือไม่ ?",
          icon: 'warning',
          reverseButtons: true,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ยกเลิก'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              'type': 'post', 
              'url': "{{ url('admin/approve_user') }}", 
              'dataType': 'text',
              'data': { 'customer_id' : customer_id, 
                        '_token' : "{{csrf_token()}}" 
                      },
              'success': function (data){
                    Swal.fire(
                      'อนุมัตืบัญชีเสร็จสิ้น !',
                      'บัญชีดังกล่าวได้ถูกอนุมัตืเรียบร้อย.',
                      'success'
                    )
                    window.location.reload();
              }
            });
          }
        })
    });

});
</script>
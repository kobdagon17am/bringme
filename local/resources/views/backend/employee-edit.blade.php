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
                    <form method="post" action="{{ route('admin/employee_update') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ (!empty($employee->id) ? $employee->id : '') }}">
                        <div class="p-5">
                            <div class="flex xl:flex-row flex-col gap-6">
                                <div class="w-52 mx-auto">
                                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img class="rounded-md profile_place" alt="Midone - HTML Admin Template" src="{{ (!empty($employee->profile) ? asset('local/storage/app/uploads/profile/'.$employee->profile) : asset('backend/dist/images/profile-1.jpg')) }}">
                                            <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_profile"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                        <div class="mx-auto cursor-pointer relative mt-5">
                                            <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile" name="profile">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">ชื่อ-นามสกุล</label>
                                                <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" name="name" value="{{ (!empty($employee->name) ? $employee->name : '') }}">
                                                @error('name')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-2" class="form-label">เบอร์โทรศัพท์</label>
                                                <input id="update-profile-form-2" type="text" class="form-control" placeholder="Input text" name="phone" value="{{ (!empty($employee->phone) ? $employee->phone : '') }}">
                                                @error('phone')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-2" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                                                <input id="update-profile-form-2" type="text" class="form-control" name="id_card" value="{{ (!empty($employee->id_card) ? $employee->id_card : '') }}">
                                                @error('id_card')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-3" class="form-label">อีเมล</label>
                                                <input id="update-profile-form-3" type="email" class="form-control" placeholder="Input text" name="email" value="{{ (!empty($employee->email) ? $employee->email : '') }}">
                                                @error('email')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6">
                                            <label for="update-profile-form-4" class="form-label">รหัสผ่าน <font color="red">(เว้นว่างไว้ในกรณีที่ไม่ต้องการแก้ไขรหัสผ่าน)</font></label>
                                            <input id="update-profile-form-4" type="password" name="password" class="form-control" placeholder="Input text" value="" autocomplete="off">
                                            @error('password')
                                            <label class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <label class="form-label">ตำแหน่ง</label>
                                            <select class="tom-select w-full" name="position">
                                                <option value="1">ผู้ดูแลระบบ</option>
                                            </select>
                                        </div>

                                        <div class="col-span-12">
                                            <div class="">
                                                <label for="update-profile-form-5" class="form-label">ที่อยู่</label>
                                                <textarea id="update-profile-form-5" class="form-control" rows="5" name="address" placeholder="Adress">{{ (!empty($employee->address) ? $employee->address : '') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-12">
                                            <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md id_card_file_place" alt="Midone - HTML Admin Template" src="{{ (!empty($employee->id_card_file) ? asset('local/storage/app/uploads/id_card_file/'.$employee->id_card_file) : asset('backend/dist/images/preview-11.jpg')) }}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_id_card_file"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 id_card_file" name="id_card_file">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-span-1 md:col-span-12">
                                            <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/preview-11.jpg') }}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="md:col-span-12">
                                            <label for="" class="form-label">สำเนาเอกสารสมัครงาน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="h-5 relative image-fit mb-5 mr-5 cursor-pointer" style="width: 100% !important;">
                                                        <label class="rounded-md register_file_place" alt="Midone - HTML Admin Template">{{ (!empty($employee->register_file) ? $employee->register_file : '') }}</label>
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_register_file"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 register_file" name="register_file">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="md:col-span-12">
                                            <label for="" class="form-label">สำเนาทะเบียนบ้าน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md address_file_place" alt="Midone - HTML Admin Template" src="{{ (!empty($employee->address_file) ? asset('local/storage/app/uploads/address_file/'.$employee->address_file) : asset('backend/dist/images/preview-11.jpg')) }}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2 remove_address_file"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 address_file" name="address_file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-5">
                                        <a href="employee.php" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</a>
                                        <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- END: Display Information -->
                </div>
            </div>
        </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      // Step 1: Select image from folder
      $('.profile').change(function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
          $('.profile_place').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
      });

      // Step 2: Replace default image with the selected image
      $('.profile').change(function() {
        const profilePlace = $('.profile_place');
        const removeProfile = $('.remove_profile');

        profilePlace.removeClass('rounded-md');
        removeProfile.css('display', 'flex');
      });

      // Step 3: Replace default image with the default profile image
      $('.remove_profile').click(function() {
        const profilePlace = $('.profile_place');
        const removeProfile = $('.remove_profile');

        profilePlace.addClass('rounded-md');
        profilePlace.attr('src', "{{asset('backend/dist/images/profile-1.jpg')}}");
        removeProfile.css('display', 'none');
      });

      // Step 1: Select image from folder
      $('.id_card_file').change(function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
          $('.id_card_file_place').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
      });

      // Step 2: Replace default image with the selected image
      $('.id_card_file').change(function() {
        const id_card_filePlace = $('.id_card_file_place');
        const removeid_card_file = $('.remove_id_card_file');

        id_card_filePlace.removeClass('rounded-md');
        removeid_card_file.css('display', 'flex');
      });

      // Step 3: Replace default image with the default id_card_file image
      $('.remove_id_card_file').click(function() {
        const id_card_filePlace = $('.id_card_file_place');
        const removeid_card_file = $('.remove_id_card_file');

        id_card_filePlace.addClass('rounded-md');
        id_card_filePlace.attr('src', "{{asset('backend/dist/images/preview-11.jpg')}}");
        removeProfile.css('display', 'none');
      });

      // Step 1: Select image from folder
      $('.register_file').change(function(e) {
        const file = e.target.files[0];
        const fileName = file.name;
        
        $('.register_file_place').text(fileName);
      });

      // Step 2: Replace default label with the selected file name
      $('.register_file').change(function() {
        const removeRegisterFile = $('.remove_register_file');

        removeRegisterFile.css('display', 'flex');
      });

      // Step 3: Replace default label with an empty string
      $('.remove_register_file').click(function() {
        const registerFilePlace = $('.register_file_place');
        const removeRegisterFile = $('.remove_register_file');

        registerFilePlace.text('');
        removeRegisterFile.css('display', 'none');
      });

      // Step 1: Select image from folder
      $('.address_file').change(function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
          $('.address_file_place').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
      });

      // Step 2: Replace default image with the selected image
      $('.address_file').change(function() {
        const address_filePlace = $('.address_file_place');
        const removeaddress_file = $('.remove_address_file');

        address_filePlace.removeClass('rounded-md');
        removeaddress_file.css('display', 'flex');
      });

      // Step 3: Replace default image with the default address_file image
      $('.remove_address_file').click(function() {
        const address_filePlace = $('.address_file_place');
        const removeaddress_file = $('.remove_address_file');

        address_filePlace.addClass('rounded-md');
        address_filePlace.attr('src', "{{asset('backend/dist/images/preview-11.jpg')}}");
        removeProfile.css('display', 'none');
      });
    });

</script>
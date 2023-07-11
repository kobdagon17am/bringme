
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
                        <form method="post" action="{{ route('admin/employee_add') }}">
                            @csrf
                        <div class="p-5">
                            <div class="flex xl:flex-row flex-col gap-6">
                                <div class="w-52 mx-auto">
                                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{asset('backend/dist/images/profile-1.jpg')}}">
                                            <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                        <div class="mx-auto cursor-pointer relative mt-5">
                                            <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                                                <input id="update-profile-form-1" name="name" type="text" class="form-control" value="{{ old('name') }}" maxlength="50" required>
                                                @error('name')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-2" class="form-label">เบอร์โทรศัพท์  <span class="text-danger">*</span></label>
                                                <input id="update-profile-form-2" name="phone" type="text" class="form-control" value="{{ old('phone') }}" minlength="10" maxlength="10" placeholder="0888888888" required>
                                                @error('phone')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-2" class="form-label">เลขบัตรประจำตัวประชาชน  <span class="text-danger">*</span></label>
                                                <input id="update-profile-form-2" name="id_card" type="text" class="form-control" value="{{ old('id_card') }}" minlength="13" maxlength="13">
                                                @error('id_card')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="">
                                                <label for="update-profile-form-3" class="form-label">อีเมล  <span class="text-danger">*</span></label>
                                                <input id="update-profile-form-3" name="email" type="email" class="form-control" value="{{ old('email') }}">
                                                @error('email')
                                                <label class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-span-12 2xl:col-span-6">
                                            <label for="update-profile-form-4" class="form-label">รหัสผ่าน  <span class="text-danger">*</span></label>
                                            <input id="update-profile-form-4" type="password" name="password" class="form-control">
                                            @error('password')
                                            <label class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>

                                        <div class="col-span-12 2xl:col-span-6">
                                            <label class="form-label">ตำแหน่ง</label>
                                            <select class="tom-select w-full">
                                                <option value="1">ผู้ดูแลระบบ 1</option>
                                                <option value="2">ผู้ดูแลระบบ 2</option>
                                                <option value="3">ผู้ดูแลระบบ 3</option>
                                            </select>
                                        </div>

                                        <div class="col-span-12">
                                            <div class="">
                                                <label for="update-profile-form-5" class="form-label">ที่อยู่</label>
                                                <textarea id="update-profile-form-5" name="address" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-span-1 md:col-span-12">
                                            <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{asset('dist/images/preview-11.jpg')}}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" >
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-span-1 md:col-span-12">
                                            <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="md:col-span-12">
                                            <label for="" class="form-label">สำเนาเอกสารสมัครงาน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{asset('dist/images/preview-11.jpg')}}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="md:col-span-12">
                                            <label for="" class="form-label">สำเนาทะเบียนบ้าน</label>
                                            <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                                <div class="flex flex-wrap px-4">
                                                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                        <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{asset('dist/images/preview-11.jpg')}}">
                                                        <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                                    </div>
                                                </div>
                                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                    <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span>
                                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-5">
                                        <a href="{{route('admin/employee')}}" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</a>
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

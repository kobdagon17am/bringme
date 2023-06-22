@extends('layouts.Admin.app')

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
                                    <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/profile-1.jpg">
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
                                        <label for="update-profile-form-1" class="form-label">ชื่อ-นามสกุล</label>
                                        <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="วีรพล อุดมทรัพย์">
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-2" class="form-label">เบอร์โทรศัพท์</label>
                                        <input id="update-profile-form-2" type="text" class="form-control" placeholder="Input text" value="089-998-8899">
                                    </div>
                                </div>

                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-2" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                                        <input id="update-profile-form-2" type="text" class="form-control" value="1129900533044">
                                    </div>
                                </div>

                                <div class="col-span-12 2xl:col-span-6">
                                    <div class="">
                                        <label for="update-profile-form-3" class="form-label">อีเมล</label>
                                        <input id="update-profile-form-3" type="email" class="form-control" placeholder="Input text" value="example@gmail.com">
                                    </div>
                                </div>
                                <div class="col-span-12 2xl:col-span-6">
                                    <label for="update-profile-form-4" class="form-label">รหัสผ่าน</label>
                                    <input id="update-profile-form-4" type="password" class="form-control" placeholder="Input text" value="Tom Cruise">
                                </div>

                                <div class="col-span-12">
                                    <div class="">
                                        <label for="update-profile-form-5" class="form-label">ที่อยู่</label>
                                        <textarea id="update-profile-form-5" class="form-control" rows="5" placeholder="Adress">10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="text-right mt-5">
                                <a href="users.php" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</a>
                                <button type="button" class="btn btn-danger w-24">บล็อกบัญชี</button>
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

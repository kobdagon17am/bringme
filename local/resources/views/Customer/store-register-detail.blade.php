<!DOCTYPE html>
<html lang="th" class="light">
<!-- BEGIN: Head -->

<head>
    <?php include 'dist/include/head.php' ?>
</head>
<!-- END: Head -->

<body class="py-5 md:py-0">
    <!-- BEGIN: Mobile Menu -->
    <?php include 'dist/include/component/MobileMenu.php' ?>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <?php include 'dist/include/component/Topbar.php' ?>
    <!-- END: Top Bar -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <?php include 'dist/include/component/SideNav.php' ?>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <h2 class="intro-y text-lg font-medium mt-10">
                ข้อมูลร้านค้า
            </h2>
            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลส่วนตัว
                            </h2>
                        </div>
                        <!-- <div class="p-5"> -->
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                                    <div>
                                        <label for="" class="form-label">ชื่อ-นามสกุล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="รชานนท์ พงศ์พินิจ">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">วันเดือนปีเกิด</label>
                                        <div class="relative">
                                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> <i data-lucide="calendar" class="w-4 h-4"></i> </div> <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="" class="form-label">อายุ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="30">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">อีเมล</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="example@mail.com">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">เบอร์ติดต่อ</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="089-782-4267">
                                    </div>

                                </div>

                                <div class="flex items-center p-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        ข้อมูลที่อยู่
                                    </h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                                    <div>
                                        <label for="" class="form-label">ห้อง/บ้านเลขที่</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                        <select id="update-profile-form-8" class="form-select">
                                            <option>กมม</option>
                                            <option>กระบี่</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                        <select id="update-profile-form-8" class="form-select">
                                            <option>กมม</option>
                                            <option>กระบี่</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="" class="form-label">รหัสไปรษณีย์</label>
                                        <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                    </div>

                                    <div class="col-span-1 md:col-span-2">
                                        <label for="update-profile-form-5" class="form-label">ที่อยู่</label>
                                        <textarea id="update-profile-form-5" class="form-control" rows="5" placeholder="Adress">10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
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
                        </div>
                        <!-- </div> -->
                        <!-- END: Display Information -->
                        <!-- BEGIN: Personal Information -->
                    </div>

                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลร้านค้า
                            </h2>
                        </div>
                        <!-- <div class="p-5"> -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">

                            <div>
                                <label for="" class="form-label">ชื่อแบรนด์</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">ประเภทสินค้า</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>อาหารคลีน</option>
                                    <option>ขนมคลีน</option>
                                    <option>เบเกอรี่</option>
                                    <option>เสื้อผ้า</option>
                                    <option>รองเท้า</option>
                                    <option>อื่นๆ</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รายละเอียดเกี่ยวกับแบรนด์และสินค้า</label>
                                <textarea class="form-control" name="" id="" rows="5"></textarea>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">วิธีการจัดเก็บสินค้า</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>Ambeint</option>
                                    <option>Chilled</option>
                                    <option>Frozen</option>
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">Shelf-life</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="" class="form-label">จำนวนรายการสินค้า (SKU)</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="" class="form-label">วันที่พร้อมส่ง</label>
                                <div class="relative">
                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                                </div>
                            </div>

                            <div>
                                <label for="" class="form-label">ช่องทาง social media</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                        </div>

                        <div class="flex items-center p-5">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลที่อยู่ร้านค้า
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
                            <div>
                                <label for="" class="form-label">ห้อง/บ้านเลขที่</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">จังหวัด</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>กมม</option>
                                    <option>กระบี่</option>
                                </select>
                            </div>

                            <div>
                                <label for="update-profile-form-8" class="form-label">เขต/อำเภอ</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>กมม</option>
                                    <option>กระบี่</option>
                                </select>
                            </div>

                            <div>
                                <label for="" class="form-label">รหัสไปรษณีย์</label>
                                <input id="" type="text" class="form-control" placeholder="Input text" value="">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างรายการสินค้า</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="" class="form-label">รูปตัวอย่างสินค้าและแพ็คเกจ</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="" class="form-label">รูปใบรับรองสินค้า / Certificate อื่นๆ (ถ้ามี)</label>
                                <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                    <div class="flex flex-wrap px-4">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                        <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>

                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                ข้อมูลบัญชีธนาคาร
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label for="" class="form-label">ชื่อธนาคาร</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div>
                                    <label for="" class="form-label">ชื่อบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div>
                                    <label for="" class="form-label">เลขบัญชี</label>
                                    <input id="" type="text" class="form-control" placeholder="Input text" value="">
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาบัตรประชาชน</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าสมุดธนาคาร</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="" class="form-label">สำเนาหน้าหนังสือรับรองบริษัท</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" alt="Midone - HTML Admin Template" src="dist/images/preview-11.jpg">
                                                <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="flex justify-end mt-4 gap-5">
                        <button type="button" class="btn btn-outline-danger w-20 ">ไม่อนุมัติ</button>
                        <button type="button" class="btn btn-primary w-20">อนุมัติ</button>
                    </div>
                    <!-- END: Personal Information -->
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>

</body>

</html>
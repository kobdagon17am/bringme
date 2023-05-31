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
                รายการสร้างใบเบิก
            </h2>

            <div class="box p-5 mt-5">
                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible mt-5">
                    <div class="flex gap-6 ">

                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap mr-5">วันเริ่ม :</label>
                            <div class="relative">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                            </div>
                        </div>

                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap sm:w-20 mr-5">วันสิ้นสุด :</label>
                            <div class="relative w-full">
                                <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                </div>
                                <input type="text" class="datepicker form-control pl-12" data-single-mode="true">
                            </div>
                        </div>

                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap sm:w-20">เวลาเริ่ม :</label>
                            <div class="flex w-full gap-5">
                                <input id="" type="time" class="form-control" placeholder="example@gmail.com">
                            </div>
                        </div>

                        <div class="form-inline">
                            <label for="" class="form-label whitespace-nowrap sm:w-20">เวลาสิ้นสุด :</label>
                            <div class="flex w-full gap-5">
                                <input id="" type="time" class="form-control" placeholder="example@gmail.com">
                            </div>
                        </div>

                        <button class="btn btn-primary"><i data-lucide="search" class="w-4 h-4 mr-2"></i> ค้นหา</button>

                    </div>
                    <table class="table table-bordered table-hover mt-5">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap"><a href="javascript:;" class="text-primary">เลือกทั้งหมด</a></th>
                                <th class="whitespace-nowrap">วันเวลาที่ออกบิล</th>
                                <th class="whitespace-nowrap">ใบเสร็จ</th>
                                <th class="whitespace-nowrap">ชื่อลูกค้า</th>
                                <th class="whitespace-nowrap">ที่อยู่จัดส่ง</th>
                                <th class="whitespace-nowrap text-center">พนังงานที่ออกบิล</th>
                                <th class="whitespace-nowrap text-center">ร้านค้า</th>
                                <th class="whitespace-nowrap text-center">สถานะการเบิก</th>
                            </tr>
                        </thead>
                        <tbody class="whitespace-nowrap">
                            <tr>
                                <td class="">
                                    <div class="form-check">
                                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td class="">2023-03-20 15:05:15</td>
                                <td class="text-center">
                                    <div class="font-bold">(P106349)</div>
                                    0123032000001<br />0123032000002
                                </td>
                                <td class="">A1000 นายจรูญ อินทนาศักดิ์</td>
                                <td class="">นายจรูญ อินทนาศักดิ์ (ตย.) 2102/1 อาคารไอยเรศวร หมู่.4 ซ.ลาดพร้าว 84<br /></td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">ร้านค้า 1</td>
                                <td class="text-center">-รอเบิกสินค้า-</td>
                            </tr>
                            <tr>
                                <td class="">
                                    <div class="form-check">
                                        <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                                <td class="">2023-03-20 15:05:15</td>
                                <td class="text-center">
                                    <div class="font-bold">(P106349)</div>
                                    0123032000001<br />0123032000002
                                </td>
                                <td class="">A1000 นายจรูญ อินทนาศักดิ์</td>
                                <td class="">นายจรูญ อินทนาศักดิ์ (ตย.) 2102/1 อาคารไอยเรศวร หมู่.4 ซ.ลาดพร้าว 84<br /></td>
                                <td class="text-center">Admin</td>
                                <td class="text-center">ร้านค้า 1</td>
                                <td class="text-center">-รอเบิกสินค้า-</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-5">
                        <button class="btn btn-primary"><i data-lucide="file-text" class="w-4 h-4"></i>สร้างใบเบิก</button>
                    </div>
                </div>
                <!-- END: Data List -->
                <!-- BEGIN: Pagination -->
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevrons-left" class="lucide lucide-chevrons-left w-4 h-4" data-lucide="chevrons-left">
                                        <polyline points="11 17 6 12 11 7"></polyline>
                                        <polyline points="18 17 13 12 18 7"></polyline>
                                    </svg> </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left" class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg> </a>
                            </li>
                            <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                            <li class="page-item active"> <a class="page-link" href="#">2</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                            <li class="page-item">
                                <a class="page-link" href="#"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
                            </li>
                        </ul>
                    </nav>
                    <select class="w-20 form-select mt-3 sm:mt-0">
                        <option>10</option>
                        <option>25</option>
                        <option>35</option>
                        <option>50</option>
                    </select>
                </div>
                <!-- END: Pagination -->
            </div>
            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3">
                                </i>
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
        <!-- END: Content -->
    </div>

</body>

</html>
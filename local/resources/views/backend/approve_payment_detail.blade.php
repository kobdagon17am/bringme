@extends('layouts.backend.app')

@section('content')
<div class="content">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">รายละเอียดขอถอนเงิน</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <?php 
                $url_unapprove = url('admin/approve_payment_unapprove');
                $url_approve = url('admin/approve_payment_approve');
                $bank = DB::table('bank')->where('id',$approve_payment_detail->bank_id)->first();
            ?>
        </div>
    </div>
    <?php $url_img = Storage::disk('public')->url(''); ?>
    <form class="intro-y grid grid-cols-12 gap-5 mt-5" id="form_approve_payment" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $approve_payment_id }}" />
        <div class="col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">ตรวจสอบคำขอถอนเงิน</div>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label for="" class="form-label">ชื่อบัญชี : {{ (!empty($approve_payment_detail) ? $approve_payment_detail->acc_name : '') }}</label><br>
                    <label for="" class="form-label">เลขบัญชี : {{ (!empty($approve_payment_detail) ? $approve_payment_detail->acc_number : '') }}</label><br>
                    <label for="" class="form-label">ธนาคาร : {{ (!empty($bank) ? $bank->txt_desc : '') }}</label><br><br>
                </div>

                <div class="col-span-1 mt-4 md:col-span-2">
                    <label for="" class="form-label">แนบภาพสลิปโอนยืนยัน</label>
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                        <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                @if(!empty($approve_payment_detail))
                                <img class="rounded-md detail_show" alt="Midone - HTML Admin Template" src="{{ asset('local/storage/app/public') }}/{{ $approve_payment_detail->slip_path }}{{ $approve_payment_detail->slip }}">
                                @else
                                <img class="rounded-md detail_show" alt="Midone - HTML Admin Template" src="{{ asset('backend/dist/images/food-beverage-1.jpg') }}">
                                @endif
                                <div title="Remove this image?" class="remove_detail_show tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">อัปโหลดไฟล์</span> หรือลากและวาง
                            <input name="slip" type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile_img ">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label for="" class="form-label">Remark</label>
                    <textarea rows="3" class="form-control" id="" rows="5" name="remark">{{ (!empty($approve_payment_detail) ? nl2br($approve_payment_detail->remark) : '') }}</textarea>
                </div>

                <div class="flex justify-end mt-4 gap-5">
                    <button type="button" class="btn btn-outline-danger w-20 cancel_approve_payment" url="{{ $url_unapprove }}">ปฏิเสธ</button>
                    <button type="button" class="btn btn-primary w-20 approve_payment" url="{{ $url_approve }}">อนุมัติ</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/ju/dt-1.13.6/b-2.4.1/r-2.5.0/sc-2.2.0/datatables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/ju/dt-1.13.6/b-2.4.1/r-2.5.0/sc-2.2.0/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('.cancel_approve_payment').click(function(){
            $('#form_approve_payment').attr('action',$(this).attr('url'));
            $('#form_approve_payment').submit();
        });

        $('.approve_payment').click(function(){
            $('#form_approve_payment').attr('action',$(this).attr('url'));
            $('#form_approve_payment').submit();
        });

        new DataTable('.datatable');

        // Get the file input element by its class
        const fileInput = $(".profile_img");

        // Add an event listener to the file input element
        fileInput.on("change", function () {
            // Check if a file is selected
            if (fileInput[0].files && fileInput[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the detail_show class
                    $(".detail_show").attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInput[0].files[0]);
            }
        });

        function changeImage(imageElement, fileInputElement) {
            if (fileInputElement[0].files && fileInputElement[0].files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Display the selected image in the specified image element
                    imageElement.attr("src", e.target.result);
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInputElement[0].files[0]);
            }
        }

        function handleImageRemoval(imageElement, fileInputElement) {
            imageElement.attr("src", "");
            fileInputElement.val("");
        }

        const profileShow = $(".detail_show");
        const removeProfileShow = $(".remove_detail_show");
        const profilefileInput = $(".profile_img");

        removeProfileShow.on("click", function () {
            handleImageRemoval(profileShow, profilefileInput);
        });

        // Add an event listener to the file input to update the displayed image when a file is selected
        profilefileInput.on("change", function () {
            changeImage(profileShow, profilefileInput);
        });

    });
</script>

@extends('layouts.backend.app')

@section('content')

<div class="content">
    @if(!empty($banner))
    <form method="POST" action="{{ url('admin/setting-banner-update') }}"  class="grid grid-cols-12 gap-6 mt-5" enctype="multipart/form-data">
    @else
    <form method="POST" action="{{ url('admin/setting-banner-create') }}"  class="grid grid-cols-12 gap-6 mt-5" enctype="multipart/form-data">
    @endif
        @csrf()
        <input type="hidden" name="id" value="{{ (!empty($banner) ? $banner->id : '') }}">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="box p-5">
                <div class="flex xl:flex-row flex-col gap-6">
                    <div class="w-52 mx-auto">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md profile_place" alt="Midone - HTML Admin Template" src="{{ (!empty($banner) ? asset('local/storage/app/public').'/'.$banner->path.'/'.$banner->img : asset('backend/dist/images/profile-1.jpg') ) }}">
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile" name="banner_img">
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div>
                                    <label for="update-profile-form-1" class="form-label mt-5">ชื่อแบนเนอร์ (TH)</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" name="name_th" value="{{ (!empty($banner) ? $banner->name_th : '') }}">
                                </div>
                            </div>
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="">
                                    <label for="update-profile-form-1" class="form-label mt-5">ชื่อแบนเนอร์ (EN)</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" name="name_en" value="{{ (!empty($banner) ? $banner->name_en : '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-5">
                                <button type="button" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</button>
                                <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

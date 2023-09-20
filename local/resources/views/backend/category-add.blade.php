@extends('layouts.backend.app')

@section('content')

<div class="content">
	@if(!empty($category))
    <form method="POST" action="{{ url('admin/setting-category-update') }}"  class="grid grid-cols-12 gap-6 mt-5" enctype="multipart/form-data">
	@else
    <form method="POST" action="{{ url('admin/setting-category-create') }}"  class="grid grid-cols-12 gap-6 mt-5" enctype="multipart/form-data">
    @endif
        @csrf()
        <input type="hidden" name="id" value="{{ (!empty($category) ? $category->id : '') }}">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="box p-5">
            	<div class="flex xl:flex-row flex-col gap-6">
                    <div class="w-52 mx-auto">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md profile_place" alt="Midone - HTML Admin Template" src="{{ (!empty($category) ? asset('local/storage/app/public').'/'.$category->path.'/'.$category->img : asset('backend/dist/images/profile-1.jpg') ) }}">
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn btn-primary w-full">เปลี่ยนรูป</button>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0 profile" name="category_img">
                            </div>
                        </div>
                    </div>

	                <div class="flex-1 mt-6 xl:mt-0">
	                    <div class="grid grid-cols-12 gap-5">
	                        <div class="col-span-12 2xl:col-span-6">
	                            <div>
						            <label for="update-profile-form-1" class="form-label mt-5">ชื่อหมวดหมู่ (TH)</label>
						            <input id="update-profile-form-1" type="text" class="form-control" name="name_th" value="{{ (!empty($category) ? $category->name_th : '') }}">
						        </div>
	                        </div>
	                        <div class="col-span-12 2xl:col-span-6">
	                            <div class="">
						            <label for="update-profile-form-1" class="form-label mt-5">ชื่อหมวดหมู่ (EN)</label>
						            <input id="update-profile-form-1" type="text" class="form-control" name="name_en" value="{{ (!empty($category) ? $category->name_en : '') }}">
	            				</div>
	            			</div>
	            			<div class="col-span-12 2xl:col-span-6">
	                            <div class="">
						            <label for="update-profile-form-1" class="form-label mt-5">สี</label>
						            <select class="form-control" name="color_id" >
						            	<option {{ (!empty($category) ? ($category->color_id == '1' ? 'selected' : '' ) : '' ) }} value="1" style="background-color: rgba(255, 255, 99, 151); ">เหลือง</option>
						            	<option {{ (!empty($category) ? ($category->color_id == '2' ? 'selected' : '' ) : '' ) }} value="2" style="background-color: rgba(187, 221, 83, 1); ">เขียว</option>
						            	<option {{ (!empty($category) ? ($category->color_id == '3' ? 'selected' : '' ) : '' ) }} value="3" style="background-color: rgba(255, 241, 162, 1); ">ครีม</option>
						            	<option {{ (!empty($category) ? ($category->color_id == '4' ? 'selected' : '' ) : '' ) }} value="4" style="background-color: rgba(241, 146, 194, 1); ">ชมพู</option>
						            	<option {{ (!empty($category) ? ($category->color_id == '5' ? 'selected' : '' ) : '' ) }} value="5" style="background-color: rgba(255, 239, 18, 1); ">เหลืองเข้ม</option>
						            	<option {{ (!empty($category) ? ($category->color_id == '6' ? 'selected' : '' ) : '' ) }} value="6" style="background-color: rgba(255, 136, 81, 1); ">ส้ม</option>
						            </select>
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

@extends('layouts.backend.app')

@section('content')

<div class="content">
	@if(!empty($category))
    <form method="POST" action="{{ url('admin/setting-category-update') }}"  class="grid grid-cols-12 gap-6 mt-5">
	@else
    <form method="POST" action="{{ url('admin/setting-category-create') }}"  class="grid grid-cols-12 gap-6 mt-5">
    @endif
        @csrf()
        <input type="hidden" name="id" value="{{ (!empty($category) ? $category->id : '') }}">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div class="box p-5">

	            <label for="update-profile-form-1" class="form-label">ชื่อหมวดหมู่ (TH)</label>
	            <input id="update-profile-form-1" type="text" class="form-control" name="name_th" value="{{ (!empty($category) ? $category->name_th : '') }}">

	            <label for="update-profile-form-1" class="form-label mt-5">ชื่อหมวดหมู่ (EN)</label>
	            <input id="update-profile-form-1" type="text" class="form-control" name="name_en" value="{{ (!empty($category) ? $category->name_en : '') }}">

                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

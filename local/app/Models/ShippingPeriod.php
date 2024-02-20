<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingPeriod extends Model
{
    // use SoftDeletes;
    protected $table = 'shipping_period';
    public $incrementing=true;

    // public function GetStatus()
    // {
    //     $data=$this->status;
    //     if($this->status==1){
    //         $data = '<b style="color:green;">อนุมัติแล้ว</b>';
    //     }elseif($this->status==0){
    //         $data = '<b style="color:red;">รออนุมัติใช้งานระบบ</b>';
    //     }
    //     return $data;
    // }

    // public function GetStatusMember()
    // {
    //     $data=$this->status_member_regis;
    //     if($this->status_member_regis==1){
    //         $data = '<b style="color:orange;">รออนุมัติเป็นผู้ให้บริการ</b>';
    //     }elseif($this->status_member_regis==0){
    //         $data = '';
    //     }elseif($this->status_member_regis==2){
    //         $data = '<b style="color:green;">อนุมัติเป็นผู้ให้บริการ</b>';
    //     }
    //     return $data;
    // }

    // public function add_gallery()
    // {
    //     $gallery = new CustomerGallery();
    //     $gallery->customer_id = $this->id;
    //     $gallery->img = $this->profile_img;
    //     $gallery->status = 1;
    //     $gallery->save();
    // }

    // public function GetDisplayType()
    // {
    //     $data=$this->display_type;
    //     if($this->display_type==1){
    //         $data = '<b style="color:black;">ทั่วไป</b>';
    //     }elseif($this->display_type==2){
    //         $data = '<b style="color:black;">หน้าใหม่</b>';
    //     }elseif($this->display_type==3){
    //         $data = '<b style="color:black;">มาแรง</b>';
    //     }elseif($this->display_type==4){
    //         $data = '<b style="color:black;">ยอดนิยม</b>';
    //     }
    //     return $data;
    // }




}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCartTrackingItem extends Model
{
    // use SoftDeletes;
    protected $table = 'customer_cart_tracking_item';
    public $incrementing=true;

}

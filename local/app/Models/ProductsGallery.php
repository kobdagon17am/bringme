<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsGallery extends Model
{
    // use SoftDeletes;
    protected $table = 'products_gallery';
    public $incrementing=true;


}

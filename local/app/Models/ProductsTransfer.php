<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsTransfer extends Model
{
    // use SoftDeletes;
    protected $table = 'products_transfer';
    public $incrementing=true;


}

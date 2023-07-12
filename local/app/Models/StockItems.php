<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockItems extends Model
{
    // use SoftDeletes;
    protected $table = 'stock_items';
    public $incrementing=true;


}

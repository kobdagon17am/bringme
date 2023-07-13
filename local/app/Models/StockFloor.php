<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockFloor extends Model
{
    // use SoftDeletes;
    protected $table = 'stock_floor';
    public $incrementing=true;


}

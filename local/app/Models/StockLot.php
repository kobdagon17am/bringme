<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockLot extends Model
{
    // use SoftDeletes;
    protected $table = 'stock_lot';
    public $incrementing=true;


}

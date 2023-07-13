<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockShelf extends Model
{
    // use SoftDeletes;
    protected $table = 'dataset_shelf';
    public $incrementing=true;


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    // use SoftDeletes;
    protected $table = 'stock';
    public $incrementing=true;


}

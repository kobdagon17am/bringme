<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\CustomerGallery;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatasetShelf extends Model
{
    // use SoftDeletes;
    protected $table = 'dataset_shelf';
    public $incrementing=true;


}

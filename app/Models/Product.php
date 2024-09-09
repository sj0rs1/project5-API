<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','image','color','height_cm','width_cm','depth_cm','weight_gr','quantity','reorder_point','last_edited_by','price'
    ];
}

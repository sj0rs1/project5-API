<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuinOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'amounts','productIds','status'
    ];
}

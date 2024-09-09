<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'mo_start',
        'mo_end',
        'tu_start',
        'tu_end',
        'we_start',
        'we_end',
        'th_start',
        'th_end',
        'fr_start',
        'fr_end',
        'sa_start',
        'sa_end',
        'su_start',
        'su_end'
    ];
}

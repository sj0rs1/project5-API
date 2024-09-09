<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'name',
        'abilities',
        'tokenable_type',
        'tokenable_id',
    ];

    /**
     * Get the model that the token belongs to.
     */
    public function tokenable()
    {
        return $this->morphTo();
    }
}

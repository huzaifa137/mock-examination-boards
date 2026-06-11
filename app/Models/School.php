<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'school_type',
        'name',
        'email',
        'phone',
        'address',
        'registration_code',
        'registration_date',
        'added_by',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\House;

class SchoolRegistration extends Model
{
    use HasFactory;

    protected $table = 'school_registrations';

    protected $fillable = [
        'school_id',
        'school_name',
        'school_name_ar',
        'location',
        'registration_date',
    ];
        
    protected $casts = [
       
        'registration_date' => 'date:Y-m-d',
    ];

    public function school()
    {
        return $this->belongsTo(House::class, 'school_id', 'ID');
    }
}
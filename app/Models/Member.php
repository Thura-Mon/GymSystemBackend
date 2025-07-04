<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $primaryKey = 'm_id'; // Primary key for the members table

    public $incrementing = true; // Assuming m_id is auto-incrementing
    protected $fillable = [
         // Primary key, auto-incremented
        'm_name',
        'm_age',
        'm_weight',
        'm_height',
        'm_phone',
        'm_email',
        'm_password',
        'm_flag', // 0 for inactive, 1 for active
        'p_id',
        'c_id',
        'm_amount',
        'm_expiry_date'
    ];

    public $timestamps = false;
}




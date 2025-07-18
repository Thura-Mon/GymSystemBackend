<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberDay extends Model
{
    protected $table = 'member_days';
    protected $primaryKey = 'day_id';    

    public $incrementing = true;
    protected $fillable = [
        'total_days',
        'today_date',
        'm_image',
        'm_id'
    ];
}

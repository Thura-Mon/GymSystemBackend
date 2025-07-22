<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    protected $table = 'bmis';
    protected $primaryKey = 'id';    

    public $incrementing = true;
    protected $fillable = [
        'bmi_status',
        'bmi_result',
        'm_id',
        'created_at'
    ];
}

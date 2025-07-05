<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
     protected $table = 'cashes';

    protected $primaryKey = 'c_id';

    public $incrementing = true; // Assuming c_id is auto-incrementing
   
    protected $fillable = [
        'c_id',
        'c_amount',
        'c_type',
        'c_flag',
        'c_note',
        'c_date',
        'm_id', // Assuming this is the member ID associated with the cash record
    ];
}

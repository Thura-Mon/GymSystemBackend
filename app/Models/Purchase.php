<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'p_id';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'p_month',
        'p_amount',
        'p_expiration',
    ];

    public $timestamps = true; // Assuming you want timestamps for this model
}






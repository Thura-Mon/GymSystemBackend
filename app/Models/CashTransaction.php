<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    protected $table = 'cash_transactions';

    protected $primaryKey = 'ct_id';

    public $incrementing = false;

    protected $keyType = 'int'; 
    protected $fillable = [
        'ct_id',
        'ct_type',
        'ct_total',
        'c_flag',
    ];

    // Define any relationships or additional methods if needed

}

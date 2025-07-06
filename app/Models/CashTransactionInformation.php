<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTransactionInformation extends Model
{
     protected $table = 'cash_transaction_information';

    protected $primaryKey = 'i_id'; // Primary key for the members table

    public $incrementing = true; // Assuming m_id is auto-incrementing
    protected $fillable = [
         // Primary key, auto-incremented
         'i_date',
         'fromtype',
         'totype',
         'amount',
         'note',
    ];

    public $timestamps = false;

}

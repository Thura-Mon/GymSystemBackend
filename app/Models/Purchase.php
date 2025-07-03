<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $primaryKey = 'p_id';      // <-- tells Laravel your PK is p_id
    public $incrementing = false;        // <-- disables auto-increment behavior
    protected $keyType = 'int';          // <-- sets key type (optional but recommended if not a string)

    protected $fillable = [
        'p_id',
        'p_month',
        'p_amount',
        'p_expiration',
    ];
}

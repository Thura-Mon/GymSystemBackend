<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyBuilder extends Model
{

    protected $table = 'body_builders';

    protected $primaryKey = 'b_id';

    public $incrementing = true;

    protected $keyType = 'int'; 

     protected $fillable = [
        'b_name',
        'b_description',
        'b_phone',
        'b_dob',
        'b_nrc',
        'b_image',
        'b_address',
        'b_certificate'

    ];

}

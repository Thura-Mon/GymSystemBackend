<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $table = 'ratings';

   

    public $incrementing = true;

    protected $keyType = 'int'; 

     protected $fillable = [
       'm_email',
       'b_id',
       'star'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable; // Required for Sanctum
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'members';

    protected $primaryKey = 'm_id';

    public $incrementing = true;

    protected $fillable = [
        'm_name',
        'm_age',
        'm_weight',
        'm_height',
        'm_phone',
        'm_email',
        'm_password',
        'm_flag',
        'p_id',
        'c_id',
        'm_amount',
        'm_expiry_date',
        'm_reg_date',
        'm_NRC',
        'm_address',
    ];

    public $timestamps = false;

    protected $hidden = [
        'm_password', // Hide password in API responses
        'remember_token',
    ];

    // Required for Laravel to know what the password column is
    public function getAuthPassword()
    {
        return $this->m_password;
    }

    // Optional: if you want email login to work properly
    public function getAuthIdentifierName()
    {
        return 'm_email';
    }

    // Member.php
public function memberDay()
{
    return $this->hasOne(MemberDay::class, 'm_id', 'm_id');
}

}

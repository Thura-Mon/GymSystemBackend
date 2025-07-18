<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberDay extends Model
{
    //  Schema::create('member_days', function (Blueprint $table) {
    //         $table->bigIncrements('day_id');
    //         $table->integer('total_days');
    //         $table->date('today_date');
    //         $table->string('m_image');
    //         $table->unsignedBigInteger('m_id');
    //         $table->foreign('m_id')->references('m_id')->on('members')
    //         ->onDelete('cascade')->onUpdate('cascade');
    //         $table->timestamps();
    //     });

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

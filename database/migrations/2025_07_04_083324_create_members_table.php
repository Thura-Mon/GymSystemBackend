<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('members', function (Blueprint $table) {
        $table->bigIncrements('m_id');
        $table->string('m_name');
        $table->integer('m_age');
        $table->integer('m_weight');
        $table->integer('m_height');
        $table->string('m_phone');
        $table->string('m_email');
        $table->string('m_password');
        $table->integer('m_flag');


        $table->unsignedBigInteger('p_id');

        $table->foreign('p_id')->references('p_id')->on('purchases')
              ->onDelete('cascade')->onUpdate('cascade');

        $table->date('m_reg_date');
        $table->date('m_expiry_date');
        $table->date('m_NRC');
        $table->date('m_address');
    
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

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
        $table->unsignedBigInteger('m_id')->primary();
        $table->string('m_name');
        $table->integer('m_age');
        $table->integer('m_weight');
        $table->integer('m_height');
        $table->string('m_phone');
        $table->string('m_email');
        $table->string('m_password');
        $table->string('m_qr_code');
        $table->integer('m_flag');


        $table->unsignedBigInteger('p_id');
        $table->unsignedBigInteger('c_id');

        $table->foreign('p_id')->references('p_id')->on('purchases')
              ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('c_id')->references('c_id')->on('cashes')
              ->onDelete('cascade')->onUpdate('cascade');

        $table->integer('m_amount');
        $table->date('m_expiry_date');
        $table->timestamps();
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

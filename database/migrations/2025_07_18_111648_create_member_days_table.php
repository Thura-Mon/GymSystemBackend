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
        Schema::create('member_days', function (Blueprint $table) {
            $table->bigIncrements('day_id');
            $table->integer('total_days');
            $table->date('today_date');
            $table->string('m_image');
            $table->unsignedBigInteger('m_id');
            $table->foreign('m_id')->references('m_id')->on('members')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_days');
    }
};

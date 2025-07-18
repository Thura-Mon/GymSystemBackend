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
        Schema::create('bmis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('m_id');
            $table->foreign('m_id')->references('m_id')->on('members')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('bmi_status');
            $table->double('bmi_result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmis');
    }
};

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
        Schema::create('purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('p_id')->primary();
            $table->string('p_month')->comment('Month of the purchase');
            $table->string('p_amount')->comment('Amount of the purchase');
            $table->string('p_expiration')->comment('Expiration date of the purchase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

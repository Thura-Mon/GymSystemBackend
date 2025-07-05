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
    
        Schema::create('cash_transaction_information', function (Blueprint $table) {
        $table->bigIncrements('i_id');
        $table->date('i_date');
        $table->string('fromtype'); // kpay
        $table->string('totype'); // Cash
        $table->integer('amount')->comment('Amount of the transaction');
        $table->string('note')->nullable()->comment('Optional note for the transaction');

        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transaction_information');
    }
};

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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('ct_id')->primary()->comment('Transaction ID');
            $table->unsignedBigInteger('c_id');
            $table->foreign('c_id')->references('c_id')->on('cashes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('ct_type')->comment('Type of transaction (e.g., deposit, withdrawal)');
            $table->integer('ct_total')->comment('Total amount of the transaction');
            $table->integer('c_flag')->comment('0, 1, 2 for different cash account types');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};

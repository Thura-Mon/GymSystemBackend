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
        Schema::create('cashes', function (Blueprint $table) {
            $table->id('c_id'); // 'true' makes it auto-increment and primary
            $table->integer('c_amount')->comment('Cash amount');
            $table->string('c_type')->comment('Type of cash account');
            $table->integer('c_flag')->comment('1, 2, 3 for different cash account types');
            $table->string('c_note')->nullable()->comment('Note for the cash account');
            $table->date('c_date')->comment('Date of the cash transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashes');
    }
};

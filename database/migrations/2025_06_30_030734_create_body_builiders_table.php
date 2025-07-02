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
        Schema::create('body_builders', function (Blueprint $table) {
            $table->id('b_id'); // shorthand for unsigned big integer + auto-increment + primary key
            $table->string('b_name')->comment('Name of the bodybuilder');
            $table->string('b_description')->nullable()->comment('Description of the bodybuilder');
            $table->string('b_phone')->comment('Phone number of the bodybuilder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_builders');
    }
};

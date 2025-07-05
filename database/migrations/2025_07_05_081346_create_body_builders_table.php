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
            $table->bigIncrements('b_id'); // auto-incrementing primary key
            $table->string('b_name')->comment('Name of the bodybuilder');
            $table->text('b_description')->nullable()->comment('Description of the bodybuilder');
            $table->string('b_phone')->comment('Phone number of the bodybuilder');
            $table->date('b_dob')->comment('Date of birth of the bodybuilder');
            $table->string('b_nrc')->comment('NRC number of the bodybuilder');
            $table->string('b_image')->nullable()->comment('Image path of the bodybuilder');
            $table->string('b_address')->comment('Address of the bodybuilder');
            $table->string('b_certificate')->nullable()->comment('Certificate file path or title');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.a
     */
    public function up(): void
    {
        Schema::create('transactionlearningstreamdetails', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');  
            $table->string('learningtrsuuid');  
            $table->string('learninguuid');
            $table->string('minutesprogress');
            $table->string('isfinish'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionlearningstreamdetails');
    }
};

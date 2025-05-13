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
        Schema::create('transactionlearningstreams', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');  
            $table->string('learningtrsuuid');  
            $table->integer('certprogress');  
            $table->integer('totalmodul');  
            $table->integer('totalfinish');  
            $table->integer('isfinish');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionlearningstreams');
    }
};

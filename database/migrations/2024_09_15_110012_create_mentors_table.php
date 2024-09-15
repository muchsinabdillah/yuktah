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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique(); 
            $table->string('useruuid'); 
            $table->string('name');
            $table->string('sex', 10); 
            $table->string('address'); 
            $table->string('companyname'); 
            $table->string('workpositionuuid'); 
            $table->date('dateofbirth'); 
            $table->integer('ratingcount')->default(0); 
            $table->integer('rating', 8, 2)->default(0.00); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};

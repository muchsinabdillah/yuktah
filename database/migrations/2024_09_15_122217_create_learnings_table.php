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
        Schema::create('learnings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique(); 
            $table->string('useruuid'); 
            $table->string('title');
            $table->text('shortdescription');
            $table->integer('studentcount');
            $table->integer('ratingcount');
            $table->integer('rating');
            $table->string('mentoruuid');
            $table->text('learndetail');
            $table->text('benefitcourse');
            $table->text('requirment');
            $table->text('description');
            $table->integer('price');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learnings');
    }
};

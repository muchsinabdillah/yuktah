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
        Schema::create('learningdetails', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36)->unique(); 
            $table->string('useruuid'); 
            $table->text('description');
            $table->string('type');
            $table->string('urldocument');
            $table->string('learninguuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learningdetails');
    }
};

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
        Schema::create('ratingapps', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('memberuuid');
            $table->decimal('ratingvalue',8,2);
            $table->text('Comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratingapps');
    }
};

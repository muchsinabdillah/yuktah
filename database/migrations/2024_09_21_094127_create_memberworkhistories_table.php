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
        Schema::create('memberworkhistories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('memberuuid');
            $table->string('workplace');
            $table->string('datestart');
            $table->string('dateend');
            $table->string('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberworkhistories');
    }
};

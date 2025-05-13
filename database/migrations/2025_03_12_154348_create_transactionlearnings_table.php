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
        Schema::create('transactionlearnings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('invoucenumber')->unique();
            $table->string('useruuid');
            $table->string('paymentid');
            $table->string('paymentmethod');
            $table->decimal('qty',8,2);
            $table->decimal('price',8,2);
            $table->decimal('discount',8,2);
            $table->decimal('applicationfee',8,2);
            $table->decimal('paymentfee',8,2); 
            $table->decimal('total',8,2); 
            $table->string('promocode'); 
            $table->string('active');  
            $table->date('date_void');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionlearnings');
    }
};

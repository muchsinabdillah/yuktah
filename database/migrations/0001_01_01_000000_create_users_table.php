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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            $table->string('uuid')->unique();
            $table->string('email',250)->unique();
            $table->string('firstname',150);
            $table->string('lastname',150);
            $table->date('dateofbirth');
            $table->string('gender',1);
            $table->integer('mobilephone');
            $table->string('domicilieprovince',35);
            $table->string('domicilieprovincename');
            $table->string('domicilieregency',35);
            $table->string('domicilieregencyname');
            $table->text('domicilieaddress');
            $table->string('referalcode',10);
            $table->text('socialmedia_fb');
            $table->text('socialmedia_twiter');
            $table->text('socialmedia_linkedin');
            $table->text('socialmedia_ig');
            $table->text('socialmedia_line');
            $table->integer('expectedsalary');
            $table->string('expectedposition');
            $table->string('expectedpositionname');
            $table->boolean('workoutdomicilie');
            $table->string('typeofmember');  
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); 
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

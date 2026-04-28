<?php
// database/migrations/xxxx_xx_xx_create_wallets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('dial_code', 10);   
            $table->string('flag', 10);             
            $table->string('country');             
            $table->string('name');                 
            $table->string('currency', 3);          
            $table->timestamps();
        });

        Schema::create('wallet_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamps();
        
            $table->unique(['wallet_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_users');
        Schema::dropIfExists('wallets');
    }
};
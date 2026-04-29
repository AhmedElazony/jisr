<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('receiver_full_name');
            $table->string('reason');
            $table->decimal('sender_amount', 15, 2);
            $table->string('sender_currency', 3);
            $table->decimal('receiver_amount', 15, 2);
            $table->string('receiver_currency', 3);
            $table->decimal('exchange_rate', 15, 6);
            $table->decimal('transaction_fee', 15, 2);
            $table->string('status')->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
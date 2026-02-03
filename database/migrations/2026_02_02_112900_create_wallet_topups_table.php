<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_topups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('client_configurations')
                ->cascadeOnDelete();

            $table->decimal('amount', 14, 2);

            $table->string('payment_method');
            // bkash, nagad, rocket, bank, stripe, sslcommerz etc

            $table->string('trx_id')->nullable();

            $table->string('proof_image')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index(['client_id', 'status']);
            $table->index('trx_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_topups');
    }
};

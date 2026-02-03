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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained('client_configurations')
                ->cascadeOnDelete();

            $table->enum('type', ['credit', 'debit']);

            $table->decimal('amount', 14, 2);
            $table->decimal('balance_before', 14, 2);
            $table->decimal('balance_after', 14, 2);

            $table->string('source'); // sms, whatsapp, refund, admin, payment, etc
            $table->string('reference_id')->nullable(); // invoice_id, message_id, trx_id
            $table->text('description')->nullable();

            $table->timestamps();

            // performance indexes
            $table->index(['client_id', 'type']);
            $table->index('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};

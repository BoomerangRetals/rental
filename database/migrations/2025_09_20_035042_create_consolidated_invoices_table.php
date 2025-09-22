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
        Schema::create('consolidated_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('consolidated_number')->unique();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->date('consolidated_date');
            $table->date('due_date')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('balance_due', 10, 2);
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->enum('payment_method', ['cash', 'bank_transfer', 'card', 'online', 'abn', 'other'])->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('payment_notes')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consolidated_invoices');
    }
};

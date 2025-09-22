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
        Schema::create('consolidated_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consolidated_invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Amount from this invoice included in consolidated
            $table->timestamps();
            
            // Ensure an invoice can only be in one consolidated invoice
            $table->unique('invoice_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consolidated_invoice_items');
    }
};

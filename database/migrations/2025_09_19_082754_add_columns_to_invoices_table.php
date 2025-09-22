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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('invoice_number')->unique()->after('id');
            $table->unsignedBigInteger('customer_id')->after('invoice_number');
            $table->unsignedBigInteger('customer_vehicle_id')->after('customer_id');
            $table->date('invoice_date')->after('customer_vehicle_id');
            $table->date('due_date')->nullable()->after('invoice_date');
            $table->decimal('subtotal', 10, 2)->default(0)->after('due_date');
            $table->decimal('tax_amount', 10, 2)->default(0)->after('subtotal');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('tax_amount');
            $table->decimal('total_amount', 10, 2)->default(0)->after('discount_amount');
            $table->decimal('paid_amount', 10, 2)->default(0)->after('total_amount');
            $table->decimal('balance_due', 10, 2)->default(0)->after('paid_amount');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid')->after('balance_due');
            $table->enum('payment_method', ['cash', 'bank_transfer', 'online', 'abn', 'card', 'other'])->nullable()->after('payment_status');
            $table->text('notes')->nullable()->after('payment_method');
            $table->text('payment_notes')->nullable()->after('notes');
            $table->enum('status', ['draft', 'sent', 'viewed', 'paid', 'overdue', 'cancelled'])->default('draft')->after('payment_notes');
            $table->timestamp('paid_at')->nullable()->after('status');
            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('customer_vehicle_id')->references('id')->on('customer_vehicles')->onDelete('cascade');
            $table->index(['customer_id', 'payment_status']);
            $table->index(['invoice_date', 'payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['customer_vehicle_id']);
            $table->dropIndex(['customer_id', 'payment_status']);
            $table->dropIndex(['invoice_date', 'payment_status']);
            
            $table->dropColumn([
                'invoice_number',
                'customer_id',
                'customer_vehicle_id',
                'invoice_date',
                'due_date',
                'subtotal',
                'tax_amount',
                'discount_amount',
                'total_amount',
                'paid_amount',
                'balance_due',
                'payment_status',
                'payment_method',
                'notes',
                'payment_notes',
                'status',
                'paid_at'
            ]);
        });
    }
};

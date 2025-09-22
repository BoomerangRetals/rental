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
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('brand');
            $table->string('model');
            $table->integer('year')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('vin')->unique();
            $table->string('colour')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel')->nullable();
            $table->string('body_type')->nullable();
            $table->string('engine_no')->nullable();
            $table->integer('odometer_reading')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_vehicles');
    }
};

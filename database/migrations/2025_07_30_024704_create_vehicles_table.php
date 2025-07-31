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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('registration_number')->unique();
            $table->string('vin')->unique();
            $table->string('colour')->nullable();
            $table->integer('seats')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('weekly');
            $table->string('transmission')->nullable();
            $table->string('fuel')->nullable();
            $table->string('body_type')->nullable();
            $table->string('engine_no')->nullable();
            $table->string('series')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('tracker')->default(false);
            $table->string('tracker_details')->nullable();
            $table->integer('bond')->default(0);
            $table->string('thumbnail')->nullable();
            $table->json('terms')->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('available'); // available, rented, maintenance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

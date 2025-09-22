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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('part_number')->nullable()->index();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->smallInteger('year')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('cost', 10, 2)->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('status')->default(1);
            $table->string('type')->nullable();
            $table->boolean('visibility')->default(1);
            $table->string('supplier')->nullable();
            $table->integer('reorder_level')->default(0);
            $table->string('thumbnail', 2083)->nullable();
            $table->json('images')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};

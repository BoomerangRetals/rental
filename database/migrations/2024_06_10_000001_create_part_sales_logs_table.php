<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('part_sales_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // operator
            $table->unsignedBigInteger('staff_id')->nullable(); // assigned staff
            $table->unsignedBigInteger('part_id');
            $table->enum('type', ['sell', 'use']);
            $table->integer('quantity');
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('part_sales_logs');
    }
};

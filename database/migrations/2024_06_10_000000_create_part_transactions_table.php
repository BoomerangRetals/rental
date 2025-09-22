<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('part_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_id');
            $table->enum('type', ['restock', 'sell', 'use']);
            $table->integer('quantity');
            $table->decimal('cost', 10, 2)->nullable(); // for restock/use
            $table->decimal('price', 10, 2)->nullable(); // for sell
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('part_transactions');
    }
};

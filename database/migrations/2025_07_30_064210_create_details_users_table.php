<?php

use App\Models\User;
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
        Schema::create('details_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->json('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable(); 
            $table->string('state')->nullable(); 
            $table->string('category')->nullable(); 
            $table->string('type')->nullable()->default('user'); // Default type is 'user'
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('country')->nullable(); 
            $table->integer('post_code')->nullable();
            $table->integer('suberb')->nullable();
            $table->integer('schedule')->nullable();
            $table->string('schedule_day')->nullable();
            $table->string('image')->nullable();
            $table->string('comment')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_users');
    }
};

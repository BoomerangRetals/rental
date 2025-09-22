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
        Schema::table('teams', function (Blueprint $table) {
            $table->text('thoughts')->nullable()->after('bio');
            $table->text('vision_statement')->nullable()->after('thoughts');
            $table->text('company_message')->nullable()->after('vision_statement');
            $table->string('business_title')->nullable()->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['thoughts', 'vision_statement', 'company_message', 'business_title']);
        });
    }
};

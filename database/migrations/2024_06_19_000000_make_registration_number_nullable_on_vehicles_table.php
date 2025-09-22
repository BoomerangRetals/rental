<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeRegistrationNumberNullableOnVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('registration_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('registration_number')->nullable(false)->change();
        });
    }
}

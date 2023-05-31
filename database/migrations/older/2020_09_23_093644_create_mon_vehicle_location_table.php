<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonVehicleLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mon_vehicle_location', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->dateTime('date');
            $table->integer('state');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
            $table->decimal('speed',5,2);
            $table->uuid('id_vehicle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mon_vehicle_location');
    }
}

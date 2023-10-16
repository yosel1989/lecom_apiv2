<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointVehicleHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_vehicle_history', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->dateTime('date');
            $table->integer('turn');
            $table->uuid('id_point');
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
        Schema::dropIfExists('point_vehicle_history');
    }
}

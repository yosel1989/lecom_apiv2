<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdMachineRealTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_machine_real_time', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('type');
            $table->string('imei',25);
            $table->uuid('id_cold_machine');
            $table->smallInteger('status')->nullable();
            //$table->string('code_alert',25)->nullable();
            $table->float('level_battery',8,2)->nullable();
            $table->float('level_fuel',8,2)->nullable();
            $table->float('level_output',8,2)->nullable();
            $table->float('frequency_output',8,2)->nullable();
            $table->float('temperature_motor',8,2)->nullable();
            $table->integer('hourmeter')->nullable();
            $table->float('temperature_supply',8,2)->nullable();
            $table->float('temperature_return',8,2)->nullable();
            $table->float('humidity',8,2)->nullable();
            $table->integer('co2')->nullable();
            $table->float('sp_temperature',8,2)->nullable();
            $table->float('sp_co2',8,2)->nullable();
            $table->float('sp_humidity',8,2)->nullable();

            $table->float('latitude',9,7);
            $table->float('longitude',9,7);

            $table->uuid('id_client');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cold_machine_real_time');
    }
}

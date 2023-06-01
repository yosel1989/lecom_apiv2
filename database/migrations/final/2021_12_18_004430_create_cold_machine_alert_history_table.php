<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdMachineAlertHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_machine_alert_history', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cold_machine_alert');
            $table->uuid('id_cold_machine');
            $table->uuid('id_client');
            $table->smallInteger('attended')->default(0);

            $table->float('latitude',9,7);
            $table->float('longitude',9,7);

            $table->uuid('id_user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cold_machine_alert_history');
    }
}

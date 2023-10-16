<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesOutSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_out_schedules', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('type');
            $table->date('date_start');
            $table->date('date_end');
            $table->dateTime('created');
            $table->integer('active');
            $table->uuid('id_client');
            $table->uuid('id_schedule_parameter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_out_schedules');
    }
}

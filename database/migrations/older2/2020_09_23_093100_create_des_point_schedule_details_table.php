<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesPointScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_point_schedule_details', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->time('h_start');
            $table->time('h_end');
            $table->integer('minutes');
            $table->integer('tolerance');
            $table->uuid('id_point_schedule');
            $table->uuid('id_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_point_schedule_details');
    }
}

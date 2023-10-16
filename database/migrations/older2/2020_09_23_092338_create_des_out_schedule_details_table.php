<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesOutScheduleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_out_schedule_details', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->date('date');
            $table->time('h_out');
            $table->integer('frequency');
            $table->uuid('id_vehicle');
            $table->uuid('id_route');
            $table->uuid('id_out_schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_out_schedule_details');
    }
}

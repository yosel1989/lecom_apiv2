<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesOutScheduleHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_out_schedule_history', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->time('h_out');
            $table->time('h_in');
            $table->date('date');
            $table->integer('order');
            $table->integer('turn');
            $table->integer('deleted');
            $table->uuid('id_employee_driver');
            $table->uuid('id_employee_collector');
            $table->uuid('id_vehicle');
            $table->uuid('id_oschedule_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_out_schedule_history');
    }
}

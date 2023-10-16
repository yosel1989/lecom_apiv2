<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesScheduleParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_schedule_parameters', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->dateTime('date');
            $table->integer('version');
            $table->string('days',25);
            $table->integer('deleted');
            $table->uuid('id_route');
            $table->uuid('id_terminal');
            $table->uuid('id_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_schedule_parameters');
    }
}

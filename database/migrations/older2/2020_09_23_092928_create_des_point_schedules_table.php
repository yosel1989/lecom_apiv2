<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesPointSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_point_schedules', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('days',25);
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('des_point_schedules');
    }
}

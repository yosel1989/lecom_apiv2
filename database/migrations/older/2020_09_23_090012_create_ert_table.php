<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ert', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('period');
            $table->integer('sutran');
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_vehicle');
            $table->uuid('id_type');
            $table->uuid('id_gps');
            $table->uuid('id_sim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ert');
    }
}

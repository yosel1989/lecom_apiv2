<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('plate',7);
            $table->string('unit',10);
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_brand')->nullable();
            $table->uuid('id_category')->nullable();
            $table->uuid('id_model')->nullable();
            $table->uuid('id_class')->nullable();
            $table->uuid('id_fleet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}

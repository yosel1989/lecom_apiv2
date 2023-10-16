<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesSparameterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('des_sparameter_details', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->time('h_start');
            $table->time('h_end');
            $table->integer('frequency');
            $table->integer('accumulated');
            $table->integer('deleted');
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
        Schema::dropIfExists('des_sparameter_details');
    }
}

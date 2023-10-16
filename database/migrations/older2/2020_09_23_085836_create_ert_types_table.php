<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErtTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ert_types', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('model',25);
            $table->string('brand',25);
            $table->integer('type_coordenate');
            $table->integer('calc_voltage');
            $table->integer('calc_voltage2');
            $table->integer('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ert_types');
    }
}

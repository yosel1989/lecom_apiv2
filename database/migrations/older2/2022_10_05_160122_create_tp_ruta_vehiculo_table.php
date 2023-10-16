<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpRutaVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_ruta_vehiculo', function (Blueprint $table) {
            $table->uuid('id_ruta');
            $table->uuid('id_vehiculo');
            $table->primary(['id_ruta','id_vehiculo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_ruta_vehiculo');
    }
}

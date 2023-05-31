<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpTipoRutaParaderoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_tipo_ruta_paradero', function (Blueprint $table) {
            $table->uuid('id_tipo_ruta');
            $table->uuid('id_paradero');
            $table->integer('id_tipo_paradero');
            $table->primary(['id_tipo_ruta','id_paradero']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_tipo_ruta_paradero');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpAbordajeDestinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_abordaje_destino', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_client');
            $table->uuid('id_vehicle')->nullable();
            $table->string('matricula',50);
            $table->uuid('id_ruta')->nullable();
            $table->uuid('id_tipo_ruta');
            $table->uuid('id_paradero_abordaje');
            $table->uuid('id_paradero_destino');
            $table->time('hora')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_abordaje_destino');
    }
}

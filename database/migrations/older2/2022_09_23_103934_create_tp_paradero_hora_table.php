<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpParaderoHoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_paradero_hora', function (Blueprint $table) {
            $table->uuid('id_paradero');
            $table->uuid('id_ruta');
            $table->uuid('id_tipo_ruta');
            $table->integer('id_tipo_paradero');
            $table->time('hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_paradero_hora');
    }
}

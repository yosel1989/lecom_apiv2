<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->smallInteger("codigo");
            $table->string('placa',10);
            $table->string('unidad',10);
            $table->uuid('id_cliente');
            $table->uuid('id_marca')->nullable();
            $table->uuid('id_categoria')->nullable();
            $table->uuid('id_modelo')->nullable();
            $table->uuid('id_clase')->nullable();
            $table->uuid('id_flota')->nullable();
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', "codigo", 'placa', 'unidad', 'id_cliente', 'id_marca', 'id_categoria', 'id_modelo', 'id_clase', 'id_flota', 'id_estado', 'id_eliminado', 'id_usu_registro', 'f_registro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};

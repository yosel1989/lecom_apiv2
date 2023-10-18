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
        Schema::create('caja_diario', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_caja');
            $table->uuid('id_ruta')->nullable();
            $table->uuid('id_cliente');
            $table->decimal('monto_inicial',8,2)->default(0.0);
            $table->decimal('monto_final',8,2)->nullable();
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_apertura');
            $table->timestamp('f_cierre')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'id_caja', 'id_ruta', 'id_cliente', 'monto_inicial', 'monto_final', 'id_estado', 'id_eliminado', 'id_usu_registro', 'f_apertura', 'f_cierre', 'f_registro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_diario');
    }
};

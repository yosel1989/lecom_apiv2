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
            $table->uuid('idCaja');
            $table->uuid('idRuta')->nullable();
            $table->uuid('idCliente');
            $table->decimal('montoInicial',8,2)->default(0.0);
            $table->decimal('montoFinal',8,2)->nullable();
            $table->tinyInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->uuid('idUsuarioRegistro');
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaApertura');
            $table->timestamp('fechaCierre')->nullable();
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();
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

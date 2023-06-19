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
            $table->string('placa',7);
            $table->string('unidad',10);
            $table->uuid('idCliente');
            $table->uuid('idMarca')->nullable();
            $table->uuid('idCategoria')->nullable();
            $table->uuid('idModelo')->nullable();
            $table->uuid('idClase')->nullable();
            $table->uuid('idFlota')->nullable();
            $table->tinyInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();
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

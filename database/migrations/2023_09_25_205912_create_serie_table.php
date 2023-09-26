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
        Schema::create('ce_serie', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('nombre', 4);
            $table->uuid('idSede');
            $table->uuid('idCliente');
            $table->integer('idTipoComprobante');
            $table->integer('idEstado');


            $table->uuid('idUsuarioRegistro');
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_serie');
    }
};

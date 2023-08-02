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
        Schema::create('venta_boleto_interprovincial_base', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idBoleto');
            $table->uuid('numeroDocumento');
            $table->uuid('idCaja')->nullable();
            $table->uuid('idPos')->nullable();
            $table->decimal('pago',8,2)->default(0.0);
            $table->decimal('vuelto',8,2)->nullable();
            $table->tinyInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->uuid('idUsuarioRegistro');
            $table->uuid('idUsuarioModifico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_boleto_interprovincial_base');
    }
};

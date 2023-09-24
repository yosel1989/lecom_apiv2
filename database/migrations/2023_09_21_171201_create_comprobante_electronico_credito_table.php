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
        Schema::create('ce_comprobante_electronico_credito', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idComprobante');
            $table->uuid('idCliente');
            $table->integer('numeroCuota');
            $table->date('fechaPago');
            $table->decimal('importe', 14 ,2);


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
        Schema::dropIfExists('ce_comprobante_electronico_credito');
    }
};

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
        Schema::create('comprobante_electronico', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idCliente');
            $table->integer('idTipoDocumento');
            $table->string('numeroDocumento',25);
            $table->string('nombre',250);
            $table->string('direccion',250)->nullable();
            $table->integer('idRazon');
            $table->string('serie',50);
            $table->integer('numero');
            $table->integer('idTipoMoneda');
            $table->integer('idTipoPago');
            $table->decimal('subTotal',10,2);
            $table->decimal('igv',10,2)->default(0);
            $table->decimal('total',10,2);
            $table->string('observaciones');
            $table->smallInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->uuid('idUsuarioRegistro');
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();

            $table->uuid('idProducto')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobante_electronico');
    }
};

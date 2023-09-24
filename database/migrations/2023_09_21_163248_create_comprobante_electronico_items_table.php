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
        Schema::create('ce_comprobante_electronico_items', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idComprobante');
            $table->uuid('idCliente');
            $table->integer('idUnidadMedida');
            $table->string('codigo', 250)->nullable();
            $table->string('descripcion', 250);
            $table->decimal('cantidad', 22, 10);
            $table->decimal('valorUnitario', 22, 10);
            $table->decimal('precioUnitario', 22, 10);
            $table->decimal('descuento', 14, 2)->default(0);
            $table->decimal('subTotal', 14, 2);
            $table->integer('idTipoIgv');
            $table->integer('idTipoIvap')->nullable();
            $table->decimal('igv', 14, 2);
            $table->decimal('impBolsa', 14, 2)->default(0);
            $table->decimal('total', 14, 2);

            $table->boolean('anticipoRegularizar')->default(false);
            $table->string('anticipoComprobanteSerie', 4)->nullable();
            $table->string('anticipoComprobanteNumero', 8)->nullable();

            $table->string('codigoProductoSunat', 8)->nullable();
            $table->decimal('tipoIsc', 14, 2)->default(0);
            $table->decimal('isc', 14, 2)->default(0);


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
        Schema::dropIfExists('ce_comprobante_electronico_items');
    }
};

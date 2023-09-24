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
        Schema::create('ce_comprobante_electronico', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();

            $table->integer('idTipoComprobante');
            $table->string('serie', 15);
            $table->integer('numero');
            $table->integer('idSunatTransaccion');


            $table->uuid('idClienteSunat')->nullable();
            $table->integer('idClienteSunatTipoDocumento');
            $table->string('clienteSunatNumeroDocumento',15);
            $table->string('clienteSunatNombre',100);
            $table->string('clienteSunatDireccion',100)->nullable();
            $table->string('clienteEmail',250)->nullable();
            $table->string('clienteEmail1',250)->nullable();
            $table->string('clienteEmail2',250)->nullable();

            $table->dateTime('fechaEmision');
            $table->dateTime('fechaVencimiento')->nullable();

            $table->integer('idMoneda');
            $table->decimal('tipoCambio',4,3)->nullable();
            $table->decimal('porcentajeIgv',4,2)->default(0);
            $table->decimal('descuentoGlobal',14,2)->default(0);
            $table->decimal('totalDescuento',14,2)->default(0);
            $table->decimal('totalAnticipo',14,2)->default(0);
            $table->decimal('totalGravada',14,2)->default(0);
            $table->decimal('totalInafecta',14,2)->default(0);
            $table->decimal('totalExonerada',14,2)->default(0);
            $table->decimal('totalIgv',14,2)->default(0);
            $table->decimal('totalGratuita',14,2)->default(0);
            $table->decimal('totalOtros',14,2)->default(0);
            $table->decimal('totalIsc',14,2)->default(0);
            $table->decimal('total',14,2)->default(0);

            $table->integer('idPercepcionTipo')->nullable();
            $table->decimal('percepcionBaseImponible',14,2)->default(0);
            $table->decimal('totalPercepcion',14,2)->default(0);
            $table->decimal('totalIncluidoPercepcion',14,2)->default(0);

            $table->integer('idRetencionTipo')->nullable();
            $table->decimal('retencionBaseImponible',14,2)->default(0);
            $table->decimal('totalRetencion',14,2)->default(0);

            $table->decimal('totalImpBolsa',14,2)->default(0);
            $table->string('observaciones',1000)->nullable();

            $table->integer('idTipoComprobanteModifica')->nullable();
            $table->string('serieComprobanteModifica',4)->nullable();
            $table->integer('numeroComprobanteModifica')->nullable();

            $table->integer('idTipoNotaCredito')->nullable();
            $table->integer('idTipoNotaDebito')->nullable();

            $table->boolean('enviarSunat')->default(true);
            $table->boolean('enviarCliente')->default(false);

            $table->string('condicionesPago',250)->nullable();
            $table->string('medioPago',250)->nullable();

            $table->string('placaVehiculo',8)->nullable();
            $table->string('ordenCompraServicio',20)->nullable();

            $table->boolean('detraccion')->default(false);
            $table->uuid('idDetraccion')->nullable();

            $table->string('formato_de_pdf', 5)->nullable();

            $table->boolean('contingencia')->default(false);
            $table->boolean('bienesRegionSelva')->default(false);
            $table->boolean('servRegionSelva')->default(false);

            $table->integer('idRazon');
            $table->uuid('idProducto')->nullable();

            $table->smallInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
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
        Schema::dropIfExists('ce_comprobante_electronico');
    }
};

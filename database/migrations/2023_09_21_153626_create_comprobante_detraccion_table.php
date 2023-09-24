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
        Schema::create('ce_comprobante_electronico_detraccion', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idComprobante');
            $table->uuid('idCliente');

            $table->integer('idTipoDetraccion')->nullable();
            $table->decimal('detraccionTotal',14,2)->default(0);
            $table->decimal('detraccionPorcentaje',8,5)->default(0);
            $table->integer('idMedioPagoDetraccion')->nullable();
            $table->string('ubigeoOrigen', 6)->nullable();
            $table->string('direccionOrigen', 100)->nullable();
            $table->string('ubigeoDestino', 6)->nullable();
            $table->string('direccionDestino', 100)->nullable();
            $table->string('detalleViaje', 100)->nullable();

            $table->decimal('val_ref_serv_trans',14,2)->default(0);
            $table->decimal('val_ref_carga_efec',14,2)->default(0);
            $table->decimal('val_ref_carga_util',14,2)->default(0);

            $table->string('punto_origen_viaje',6)->nullable();
            $table->string('punto_destino_viaje',6)->nullable();
            $table->string('descripcion_tramo',100)->nullable();

            $table->decimal('val_ref_carga_efec_tramo_virtual',14,2)->default(0);
            $table->string('config_vehicular',15)->nullable();
            $table->decimal('carga_util_tonel_metricas',14,2)->default(0);
            $table->decimal('carga_efec_tonel_metricas',14,2)->default(0);
            $table->integer('val_ref_tonel_metrica')->nullable();
            $table->decimal('val_pre_ref_carga_util_nominal',14,2)->default(0);

            $table->boolean('indicador_aplicacion_retorno_vacio')->default(false);
            $table->string('matricula_emb_pesquera', 15)->nullable();
            $table->string('nombre_emb_pesquera', 50)->nullable();
            $table->string('descripcion_tipo_especie_vendida', 100)->nullable();
            $table->string('lugar_de_descarga', 200)->nullable();
            $table->string('cantidad_especie_vendida',14,2)->default(0);
            $table->date('fecha_de_descarga')->nullable();

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
        Schema::dropIfExists('ce_comprobante_electronico_detraccion');
    }
};

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
            $table->uuid('id_cliente');
            $table->uuid('id_sede')->nullable();

            $table->integer('id_tipo_comprobante');
            $table->string('serie', 15);
            $table->integer('numero');
            $table->integer('id_sunat_transaccion');


//            $table->uuid('idClienteSunat')->nullable();
            $table->integer('id_tipo_documento_entidad');
            $table->string('numero_documento_entidad',15);
            $table->string('nombre_entidad',100);
            $table->string('direccion_entidad',100)->nullable();
            $table->string('email',250)->nullable();
            $table->string('email1',250)->nullable();
            $table->string('email2',250)->nullable();

            $table->dateTime('f_emision');
            $table->dateTime('f_vencimiento')->nullable();

            $table->integer('id_moneda');
            $table->decimal('tipo_cambio',4,3)->nullable();
            $table->decimal('porcentaje_igv',4,2)->default(0);
            $table->decimal('descuento_global',14,2)->default(0);
            $table->decimal('to_descuento',14,2)->default(0);
            $table->decimal('to_anticipo',14,2)->default(0);
            $table->decimal('to_gravada',14,2)->default(0);
            $table->decimal('to_inafecta',14,2)->default(0);
            $table->decimal('to_exonerada',14,2)->default(0);
            $table->decimal('to_igv',14,2)->default(0);
            $table->decimal('to_gratuita',14,2)->default(0);
            $table->decimal('to_otros',14,2)->default(0);
            $table->decimal('to_isc',14,2)->default(0);
            $table->decimal('total',14,2)->default(0);

            $table->integer('id_percepcion_tipo')->nullable();
            $table->decimal('percepcion_base_imponible',14,2)->default(0);
            $table->decimal('to_percepcion',14,2)->default(0);
            $table->decimal('to_incluido_percepcion',14,2)->default(0);

            $table->integer('id_retencion_tipo')->nullable();
            $table->decimal('retencion_base_imponible',14,2)->default(0);
            $table->decimal('to_retencion',14,2)->default(0);

            $table->decimal('to_imp_bolsa',14,2)->default(0);
            $table->string('observaciones',1000)->nullable();

            $table->integer('id_tipo_comprobante_modif')->nullable();
            $table->string('serie_comprobante_modif',4)->nullable();
            $table->integer('numero_comprobante_modif')->nullable();

            $table->integer('id_tipo_nota_credito')->nullable();
            $table->integer('id_tipo_nota_debito')->nullable();

            $table->boolean('bl_enviar_sunat')->default(true);
            $table->boolean('bl_enviar_cliente')->default(false);

            $table->string('condiciones_pago',250)->nullable();
            $table->string('medio_pago',250)->nullable();

            $table->string('placa_vehiculo',8)->nullable();
            $table->string('order_compra_servicio',20)->nullable();

            $table->boolean('bl_detraccion')->default(false);
            $table->uuid('id_detraccion')->nullable();

            $table->string('formato_de_pdf', 6)->nullable();

            $table->boolean('contingencia')->default(false);
            $table->boolean('bienes_region_selva')->default(false);
            $table->boolean('serv_region_selva')->default(false);

            $table->integer('id_razon');
            $table->uuid('id_producto')->nullable();


            $table->smallInteger('id_estado')->default(1);
            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();
            $table->timestamp('id_empresa')->nullable();

            $table->index([
                'id_sede',
                'id_cliente',
                'id_razon',
                'f_registro',

                'f_emision',
                'id_tipo_comprobante',
                'serie',
                'numero',
                'id_sunat_transaccion',
                'id_moneda',
                'id_tipo_nota_credito',
                'id_tipo_nota_debito',
                'id_detraccion',
                'id_tipo_comprobante_modif',
                'id_percepcion_tipo',
                'id_retencion_tipo',

                'id_estado',
                'id_usu_registro',
                'id_usu_modifico',
                'id_empresa'
            ]);

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

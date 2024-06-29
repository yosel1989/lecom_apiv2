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
        Schema::create('ingreso', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->integer('id_tipo_comprobante');
            $table->string('serie');
            $table->integer('numero');
            $table->uuid('id_tipo_ingreso');
            $table->string('detalle', 250)->nullable();

            $table->integer('id_tipo_documento_entidad');
            $table->string('numero_documento_entidad',15);
            $table->string('nombre_entidad',100);

            $table->uuid('id_sede');
            $table->decimal('importe',10,2);
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_caja');
            $table->uuid('id_caja_diario');
            $table->boolean('bl_contabilizado');
            $table->boolean('bl_aprobado');
            $table->boolean('bl_revisado');
            $table->integer('id_medio_pago');
            $table->string('numero_operacion', 25)->nullable();
            $table->integer('id_entidad_financiera')->nullable();
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id',
                'id_cliente',
                'id_tipo_comprobante',
                'serie',
                'numero',
                'id_tipo_ingreso',
                'detalle',
                'id_tipo_documento_entidad',
                'numero_documento_entidad',
                'nombre_entidad',
                'id_sede',
                'importe',
                'id_estado',
                'id_eliminado',
                'id_caja',
                'id_caja_diario',
                'bl_contabilizado',
                'bl_aprobado',
                'bl_revisado',
                'id_medio_pago',
                'numero_operacion',
                'id_entidad_financiera',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro',
                'f_modifico',
            ]);

            $table->unique([
                'id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingreso');
    }
};

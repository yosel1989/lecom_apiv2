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
        Schema::create('egreso', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->integer('id_tipo_comprobante');
            $table->string('serie');
            $table->integer('numero');
            $table->integer('id_tipo_documento_entidad');
            $table->string('numero_documento_entidad',15);
            $table->string('nombre_entidad',100);
            $table->uuid('id_sede');
            $table->uuid('id_vehiculo')->nullable();
            $table->uuid('id_personal')->nullable();
            $table->decimal('total',10,2);
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_caja');
            $table->uuid('id_caja_diario');
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
                'id_tipo_documento_entidad',
                'numero_documento_entidad',
                'nombre_entidad',
                'id_sede',
                'id_vehiculo',
                'id_personal',
                'total',
                'id_estado',
                'id_eliminado',
                'id_caja',
                'id_caja_diario',
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
        Schema::dropIfExists('egreso');
    }
};

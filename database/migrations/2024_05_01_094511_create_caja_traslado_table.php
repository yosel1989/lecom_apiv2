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
        Schema::create('caja_traslado', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->integer('id_tipo_comprobante');
            $table->string('serie');
            $table->integer('numero');
            $table->uuid('id_personal');
            $table->uuid('id_sede');
            $table->uuid('id_caja_origen');
            $table->uuid('id_caja_diario_origen');
            $table->uuid('id_caja_destino');
            $table->uuid('id_caja_diario_destino');
            $table->decimal('monto',10,2);
            $table->integer('id_medio_pago')->default(1);
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
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
                'id_personal',
                'id_sede',
                'id_caja_origen',
                'id_caja_diario_origen',
                'id_caja_destino',
                'id_caja_diario_destino',
                'monto',
                'id_medio_pago',
                'id_estado',
                'id_eliminado',
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
        Schema::dropIfExists('caja_traslado');
    }
};

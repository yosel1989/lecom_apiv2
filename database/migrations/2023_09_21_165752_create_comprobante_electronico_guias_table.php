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
        Schema::create('ce_comprobante_electronico_guias', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_comprobante');
            $table->uuid('id_cliente');
            $table->uuid('id_tipo_guia');
            $table->string('serie', 4);
            $table->integer('numero');


            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id_comprobante',
                'id_cliente',
                'id_tipo_guia',
                'serie',
                'numero',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro',
                'f_modifico'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_comprobante_electronico_guias');
    }
};

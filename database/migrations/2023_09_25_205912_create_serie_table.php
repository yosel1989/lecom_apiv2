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
        Schema::create('ce_serie', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('nombre', 4);
            $table->uuid('id_sede');
            $table->uuid('id_cliente');
            $table->integer('id_tipo_comprobante');
            $table->uuid('id_empresa')->nullable();
            $table->integer('id_estado');


            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'nombre', 'id_sede', 'id_cliente', 'id_tipo_comprobante', 'id_estado', 'id_usu_registro', 'f_registro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_serie');
    }
};

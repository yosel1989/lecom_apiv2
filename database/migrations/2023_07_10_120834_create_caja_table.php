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
        Schema::create('caja', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('nombre',100);
            $table->uuid('id_sede')->nullable();
            $table->uuid('id_pos')->nullable();
            $table->uuid('id_cliente');
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->boolean('bl_punto_venta')->default(false);
            $table->boolean('bl_despacho')->default(false);
            $table->boolean('bl_principal')->default(false);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'nombre', 'id_sede', 'id_pos', 'id_cliente', 'id_estado', 'id_eliminado', 'id_usu_registro', 'f_registro', 'bl_despacho', 'bl_punto_venta', 'bl_principal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja');
    }
};

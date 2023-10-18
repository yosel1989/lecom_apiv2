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
        Schema::create('boleto_precio', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->mediumInteger('id_tipo_ruta');
            $table->uuid('id_ruta');

            $table->uuid('id_paradero_origen');
            $table->uuid('id_paradero_destino');


            $table->decimal('precio_base',5,2)->default(0.0);
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'id_tipo_ruta', 'id_ruta', 'id_paradero_origen', 'id_paradero_destino', 'precio_base', 'id_estado', 'id_eliminado', 'id_usu_registro', 'f_registro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viaje_precio');
    }
};

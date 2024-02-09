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
        Schema::create('liquidacion_estado_motivo', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->uuid('id_liquidacion');
            $table->integer('id_liquidacion_motivo');
            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id',
                'id_cliente',
                'id_liquidacion',
                'id_liquidacion_motivo',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro',
                'f_modifico'
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
        Schema::dropIfExists('liquidacion_estado_motivo');
    }
};

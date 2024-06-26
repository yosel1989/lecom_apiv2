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
        Schema::create('egreso_detalle', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_egreso');
            $table->uuid('id_cliente');
            $table->uuid('id_egreso_tipo');
            $table->string('detalle', 150)->nullable();
            $table->date('fecha');
            $table->decimal('importe',10,2);
            $table->integer('id_medio_pago');
            $table->string('numero_documento',50)->nullable();
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();
            $table->uuid('id_liquidacion')->nullable();

            $table->index([
                'id_egreso',
                'id_cliente',
                'id_egreso_tipo',
                'detalle',
                'fecha',
                'importe',
                'id_medio_pago',
                'numero_documento',
                'id_estado',
                'id_eliminado',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro',
                'f_modifico',
                'id_liquidacion',
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
        Schema::dropIfExists('egreso_detalle');
    }
};

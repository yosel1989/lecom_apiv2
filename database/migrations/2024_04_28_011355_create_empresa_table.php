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
        Schema::create('ce_empresa', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('nombre',150);
            $table->string('ruc',20);
            $table->string('direccion',150);
            $table->string('id_ubigeo',6)->nullable();
            $table->uuid('id_cliente');
            $table->boolean('predeterminado')->default(false);
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id',
                'nombre',
                'ruc',
                'direccion',
                'id_ubigeo',
                'id_cliente',
                'predeterminado',
                'id_estado',
                'id_eliminado',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_empresa');
    }
};

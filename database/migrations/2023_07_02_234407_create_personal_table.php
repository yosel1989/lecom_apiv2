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
        Schema::create('personal', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('foto')->nullable();
            $table->string('nombre',150);
            $table->string('apellido',150);
            $table->string('correo',150)->nullable();
            $table->uuid('id_cliente');
            $table->integer('id_tipo_documento')->nullable();
            $table->uuid('id_sede')->nullable();
            $table->string('numero_documento',20)->nullable();
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'nombre', 'apellido', 'id_cliente', 'id_tipo_documento', 'numero_documento', 'id_estado', 'id_eliminado', 'id_usu_registro', 'id_usu_modifico', 'f_registro', 'f_modifico']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};

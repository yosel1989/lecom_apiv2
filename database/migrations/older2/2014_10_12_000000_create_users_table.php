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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->uuid('id_personal')->nullable()->unique();
            $table->uuid('id_sede')->nullable();
            $table->uuid('id_perfil')->nullable();
            $table->uuid('id_rol')->nullable();
            $table->uuid('id_cliente')->nullable();
            $table->string('correo')->unique()->nullable();
            $table->string('telefono', 150)->nullable();
            $table->string('usuario', 20)->unique();
            $table->string('clave');
            $table->smallInteger('id_nivel');
            $table->tinyInteger('id_estado')->default(1);
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('fechaEmailVerifico')->nullable();
            //$table->rememberToken();
            $table->tinyInteger('id_eliminado')->default(0);
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index(['id', 'id_personal', 'id_sede', 'id_perfil', 'id_rol', 'id_cliente', 'usuario', 'id_nivel', 'id_estado', 'id_usu_registro', 'id_usu_modifico', 'id_eliminado', 'f_registro', 'f_modifico']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
            $table->uuid('idPerfil')->nullable();
            $table->string('correo')->unique()->nullable();
            $table->string('telefono', 150)->nullable();
            $table->string('usuario', 20);
            $table->string('clave');
            $table->smallInteger('idNivel');
            $table->tinyInteger('idEstado')->default(1);
            $table->uuid('idUsuarioRegistro')->nullable();
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaEmailVerifico')->nullable();
            //$table->rememberToken();
            $table->tinyInteger('idEliminado')->default(0);
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();
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

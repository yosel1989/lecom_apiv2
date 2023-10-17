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
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->smallInteger('codigo')->unique();
            $table->smallInteger('idTipoDocumento')->nullable();
            $table->string('numeroDocumento',25);
            $table->string('nombre',150);
            $table->string('nombreContacto',150)->nullable();
            $table->string('correo',150)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->string('telefono1', 15)->nullable();
            $table->string('telefono2', 15)->nullable();
            $table->smallInteger('idTipo')->default(0);
            $table->tinyInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->uuid('idClientePadre')->nullable();
            $table->uuid('idUsuarioRegistro')->nullable();
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();

            $table->index(['id','codigo','idTipoDocumento','idTipo','idEstado','idEliminado','idClientePadre','idUsuarioRegistro','idUsuarioModifico','fechaRegistro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

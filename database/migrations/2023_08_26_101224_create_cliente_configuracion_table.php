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
        Schema::create('cliente_configuracion', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('idParametroConfiguracion');
            $table->integer('valor');
            $table->uuid('idCliente');
            $table->uuid('idUsuarioRegistro')->nullable();
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaRegistro')->nullable();
            $table->timestamp('fechaModifico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_configuracion');
    }
};

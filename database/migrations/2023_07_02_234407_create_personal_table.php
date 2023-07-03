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
            $table->uuid('idCliente');
            $table->uuid('idTipoDocumento')->nullable();
            $table->uuid('numeroDocumento')->nullable();
            $table->tinyInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
            $table->uuid('idUsuarioRegistro')->nullable();
            $table->uuid('idUsuarioModifico')->nullable();
            $table->timestamp('fechaRegistro');
            $table->timestamp('fechaModifico')->nullable();
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

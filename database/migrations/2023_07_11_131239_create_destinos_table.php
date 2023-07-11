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
        Schema::create('destinos', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('nombre',100);
            $table->decimal('precioBase', 5 ,2);
            $table->uuid('idCliente');
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
        Schema::dropIfExists('destinos');
    }
};

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
        Schema::create('ce_comprobante_electronico_guias', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idComprobante');
            $table->uuid('idCliente');
            $table->uuid('idTipoGuia');
            $table->string('serie', 4);
            $table->integer('numero');


            $table->uuid('idUsuarioRegistro');
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
        Schema::dropIfExists('ce_comprobante_electronico_guias');
    }
};

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
        Schema::create('comprobante_electronico_detalle', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('idComprobante');
            $table->uuid('idCliente');
            $table->integer('idUnidadMedida');
            $table->integer('idProducto');
            $table->string('producto',250);
            $table->string('detalle',250);
            $table->integer('cantidad' );
            $table->decimal('valor',10,2);
            $table->decimal('subTotal',10,2);
            $table->decimal('igv',10,2)->default(0);
            $table->decimal('total',10,2);
            $table->smallInteger('idEstado')->default(1);
            $table->tinyInteger('idEliminado')->default(0);
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
        Schema::dropIfExists('comprobante_electronico_detalle');
    }
};

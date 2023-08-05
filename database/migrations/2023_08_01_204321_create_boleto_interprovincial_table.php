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
        Schema::create('boleto_interprovincial_base', function (Blueprint $table) {
                $table->uuid('id')->unique()->primary();
                $table->uuid('idSede')->nullable();
                $table->uuid('idRuta')->nullable();
                $table->uuid('idParadero')->nullable();
                $table->uuid('idVehiculo')->nullable();
                $table->uuid('idCaja')->nullable();
                $table->uuid('idPos')->nullable();
                $table->uuid('idCliente')->nullable();
                $table->smallInteger('idTipoDocumento')->nullable();
                $table->string('numeroDocumento',20)->nullable();
                $table->string('nombre',250)->nullable();
                $table->string('direccion',250)->nullable();
                $table->string('serie',20)->nullable();
                $table->string('numeroBoleto',50)->nullable();
                $table->string('codigoBoleto',30)->nullable();
                $table->decimal('latitud',10,8)->nullable();
                $table->decimal('longitud',10,8)->nullable();
                $table->decimal('precio',5,2);
                $table->dateTime('fecha');
                $table->tinyInteger('idEstado')->default(1);
                $table->tinyInteger('idEliminado')->default(0);
                $table->tinyInteger('anulado')->default(0);
                $table->tinyInteger('enBlanco')->default(0);
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
        Schema::dropIfExists('boleto_interprovincial_base');
    }
};

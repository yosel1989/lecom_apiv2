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
                $table->uuid('idCliente');
                $table->uuid('idSede');
                $table->uuid('idCaja')->nullable();
                $table->integer('idTipoDocumento');
                $table->string('numeroDocumento',20);
                $table->string('nombres',250);
                $table->string('apellidos',250);
                $table->boolean('menorEdad')->default(false);


                $table->uuid('idVehiculo')->nullable();
                $table->uuid('idAsiento')->nullable();
                $table->date('fechaPartida')->nullable();
                $table->time('horaPartida')->nullable();
                $table->uuid('idRuta');
                $table->uuid('idParadero');
                $table->decimal('precio',5,2);
                $table->integer('idTipoMoneda');
                $table->integer('idFormaPago');
                $table->boolean('obsequio');


                $table->uuid('idPos')->nullable();
                $table->string('codigo');
//                $table->string('serie',20);
//                $table->integer('numero');
                $table->decimal('latitud')->default(0);
                $table->decimal('longitud')->default(0);


                $table->timestamp('fechaEmision');
                $table->tinyInteger('idEstado')->default(1);
                $table->uuid('idUsuarioRegistro');
                $table->uuid('idUsuarioModifico')->nullable();
                $table->timestamp('fechaRegistro');
                $table->timestamp('fechaModifico')->nullable();


                $table->integer('idTipoBoleto');
                $table->boolean('porPagar')->default(false);

//
                $table->index(['idCliente', 'fechaEmision']);
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

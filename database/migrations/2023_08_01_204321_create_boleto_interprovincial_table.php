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
        Schema::create('boleto_interprovincial', function (Blueprint $table) {
                $table->uuid('id')->unique()->primary();
                $table->uuid('id_cliente');
                $table->uuid('id_sede');
                $table->uuid('id_caja')->nullable();
                $table->integer('id_tipo_documento');
                $table->string('numero_documento',20);
                $table->string('nombres',250);
                $table->string('apellidos',250);
                $table->boolean('menor_edad')->default(false);


                $table->uuid('id_vehiculo')->nullable();
                $table->uuid('id_asiento')->nullable();
                $table->date('f_partida')->nullable();
                $table->time('h_partida')->nullable();
                $table->uuid('id_ruta');
                $table->uuid('id_paradero');
                $table->decimal('precio',5,2);
                $table->integer('id_tipo_moneda');
                $table->integer('id_forma_pago');
                $table->boolean('obsequio');


                $table->uuid('id_pos')->nullable();
                $table->string('codigo');
//                $table->string('serie',20);
//                $table->integer('numero');
                $table->decimal('latitud')->default(0);
                $table->decimal('longitud')->default(0);


                $table->timestamp('f_emision');
                $table->tinyInteger('id_estado')->default(1);
                $table->uuid('id_usu_registro');
                $table->uuid('id_usu_modifico')->nullable();
                $table->timestamp('f_registro');
                $table->timestamp('f_modifico')->nullable();


                $table->integer('id_tipo_comprobante');
                $table->integer('id_tipo_boleto');
                $table->boolean('por_pagar')->default(false);

//
                $table->index([
                    'id_cliente',
                    'id_sede',
                    'id_caja',
                    'id_tipo_documento',
                    'numero_documento',
                    'menor_edad',
                    'id_vehiculo',
                    'id_asiento',
                    'f_partida',
                    'h_partida',
                    'id_ruta',
                    'id_paradero',
                    'id_tipo_moneda',
                    'id_forma_pago',
                    'obsequio',
                    'id_pos',
                    'codigo',
                    'f_emision',
                    'id_usu_registro',
                    'id_usu_modifico',
                    'f_registro',
                    'f_modifico',
                    'id_tipo_comprobante',
                    'id_tipo_boleto',
                    'por_pagar'
                ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boleto_interprovincial');
    }
};

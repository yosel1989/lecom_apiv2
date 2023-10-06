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
        Schema::create('ce_comprobante_electronico_credito', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_comprobante');
            $table->uuid('id_cliente');
            $table->integer('num_cuota');
            $table->date('f_pago');
            $table->decimal('importe', 14 ,2);


            $table->uuid('id_usu_registro');
            $table->uuid('id_us_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id_comprobante',
                'id_cliente',
                'id_usu_registro',
                'id_us_modifico',
                'f_registro',
                'f_modifico'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ce_comprobante_electronico_credito');
    }
};

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
        Schema::create('ce_comprobante_electronico_items', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_comprobante');
            $table->uuid('id_cliente');

            $table->integer('id_unidad_medida');
            $table->uuid('codigo');
            $table->string('descripcion', 250);
            $table->decimal('cantidad', 22, 10);
            $table->decimal('valor_unitario', 22, 10);
            $table->decimal('precio_unitario', 22, 10);
            $table->decimal('descuento', 14, 2)->default(0);
            $table->decimal('sub_total', 14, 2);
            $table->integer('id_tipo_igv');
            $table->integer('id_tipo_ivap')->nullable();
            $table->decimal('igv', 14, 2);
            $table->decimal('impBolsa', 14, 2)->default(0);
            $table->decimal('total', 14, 2);

            $table->boolean('anticipo_regularizar')->default(false);
            $table->string('anticipo_comprobante_serie', 4)->nullable();
            $table->string('anticipo_comprobante_numero', 8)->nullable();

            $table->string('codigo_producto_sunat', 8)->nullable();
            $table->decimal('tipo_isc', 14, 2)->default(0);
            $table->decimal('isc', 14, 2)->default(0);


            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();

            $table->index([
                'id_comprobante',
                'id_cliente',
                'id_unidad_medida',
                'codigo',
                'id_tipo_igv',
                'id_tipo_ivap',
                'id_usu_registro',
                'id_usu_modifico',
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
        Schema::dropIfExists('ce_comprobante_electronico_items');
    }
};

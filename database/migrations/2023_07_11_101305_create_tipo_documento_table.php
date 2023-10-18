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
        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('nombre_corto', 50);
            $table->smallInteger('num_digitos');
            $table->smallInteger('apl_factura')->default(0);
            $table->smallInteger('apl_boleta')->default(0);
            $table->smallInteger('apl_pasajero')->default(0);

            $table->index(['id', 'nombre', 'nombre_corto', 'num_digitos', 'apl_factura', 'apl_boleta', 'apl_pasajero']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_documento');
    }
};

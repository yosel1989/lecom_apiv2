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
        Schema::create('historial_boleto_interprovincial', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_boleto');
            $table->uuid('id_cliente');
            $table->integer('id_accion');
            $table->string('descripcion', 150);
            $table->uuid('id_usu_registro');
            $table->timestamp('f_registro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_boleto_interprovincial');
    }
};

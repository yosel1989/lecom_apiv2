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
        Schema::create('medio_pago', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->boolean('bl_despacho')->default(false);
            $table->boolean('bl_entidad_financiera')->default(false);
            $table->integer('id_tipo');

            $table->index([
                'nombre',
                'bl_despacho',
                'bl_entidad_financiera',
                'id_tipo',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medio_pago');
    }
};

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
        Schema::create('cliente_medio_pago', function (Blueprint $table) {
            $table->uuid('id_cliente');
            $table->integer('id_medio_pago');
            $table->uuid('id_usu_registro');
            $table->timestamp('f_registro');

            $table->index([
                'id_cliente',
                'id_medio_pago',
                'id_usu_registro',
                'f_registro',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_medio_pago');
    }
};

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
        Schema::create('cliente_modulo_menu', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_cliente');
            $table->integer('id_modulo');
            $table->json('menu');
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro')->nullable();
            $table->timestamp('f_modifico')->nullable();

            $table->unique([
                'id'
            ]);
            $table->index([
                'id',
                'id_cliente',
                'id_modulo',
                'id_usu_registro',
                'id_usu_modifico',
                'f_registro',
                'f_modifico',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_modulo_menu');
    }
};

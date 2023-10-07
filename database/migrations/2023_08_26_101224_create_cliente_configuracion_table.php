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
        Schema::create('cliente_configuracion', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('id_parametro_configuracion');
            $table->string('valor');
            $table->uuid('id_cliente');
            $table->uuid('id_usu_registro')->nullable();
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro')->nullable();
            $table->timestamp('f_modifico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_configuracion');
    }
};

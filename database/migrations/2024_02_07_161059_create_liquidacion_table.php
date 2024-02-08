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
        Schema::create('liquidacion', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('codigo');
            $table->uuid('id_cliente');
            $table->json('id_vehiculos')->nullable();
            $table->uuid('id_personal')->nullable();
            $table->date('f_inicio');
            $table->date('f_fin');
            $table->string('archivo',500);
            $table->tinyInteger('id_estado')->default(1);
            $table->uuid('id_usu_registro');
            $table->uuid('id_usu_modifico')->nullable();
            $table->timestamp('f_registro');
            $table->timestamp('f_modifico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidacion');
    }
};

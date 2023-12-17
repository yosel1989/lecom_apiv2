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
        Schema::create('modulo_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('id_modulo');
            $table->string('texto', 255);
            $table->string('icono', 100)->nullable();
            $table->integer('id_tipo_menu');
            $table->integer('padre')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('id_estado')->default(1);
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
        Schema::dropIfExists('modulo_menu');
    }
};

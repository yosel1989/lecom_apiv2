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
        Schema::create('modulo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100)->unique();
            $table->string('codigo',15)->unique();
            $table->string('icono',150)->nullable();
            $table->tinyInteger('id_estado')->default(1);
            $table->tinyInteger('id_eliminado')->default(0);
            $table->uuid('id_usu_registro')->nullable();
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
        Schema::dropIfExists('modulo');
    }
};

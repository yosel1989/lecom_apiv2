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
            $table->string('nombreCorto', 50);
            $table->smallInteger('numeroDigitos');
            $table->smallInteger('aplFactura')->default(0);
            $table->smallInteger('aplBoleta')->default(0);
            $table->smallInteger('aplPasajero')->default(0);
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

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
        Schema::create('egreso_motivo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->integer('id_estado');

            $table->index([
                'id',
                'nombre',
                'id_estado'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egreso_motivo');
    }
};

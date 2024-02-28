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
        Schema::create('entidad_financiera', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',150);
            $table->integer('id_estado')->default(1);

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
        Schema::dropIfExists('entidad_financiera');
    }
};

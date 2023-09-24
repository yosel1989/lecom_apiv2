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
        Schema::create('ubigeo', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('departamento',75);
            $table->string('provincia',75);
            $table->string('distrito',75);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubigeo');
    }
};

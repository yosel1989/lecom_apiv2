<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmTipoIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_tipo_ingreso', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',100);
            $table->string('description',250)->nullable();
            $table->boolean('has_vehicle')->default(false);
            $table->boolean('has_personal')->default(false);
            $table->boolean('has_route')->default(false);
            $table->integer('id_status')->default(1);
            $table->uuid('id_client');
            $table->uuid('id_user_created');
            $table->uuid('id_user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_tipo_ingreso');
    }
}

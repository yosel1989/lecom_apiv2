<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_ruta', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',150);
            $table->string('code',15)->unique()->nullable();
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
        Schema::dropIfExists('adm_ruta');
    }
}

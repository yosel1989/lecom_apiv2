<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmEgresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_egreso', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->uuid('id_tipo_egreso');
            $table->uuid('id_vehicle')->nullable();
            $table->uuid('id_personal')->nullable();
            $table->uuid('id_route')->nullable();
            $table->uuid('id_client');
            $table->decimal('amount',10,2);
            $table->string('observation',250)->nullable();
            $table->smallInteger('id_status')->default(1);
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
        Schema::dropIfExists('adm_egreso');
    }
}

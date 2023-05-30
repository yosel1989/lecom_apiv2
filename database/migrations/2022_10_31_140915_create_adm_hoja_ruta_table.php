<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmHojaRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_hoja_ruta', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->uuid('id_vehicle');
            $table->uuid('id_personal');
            $table->uuid('id_route');
            $table->date('date_assigned');
            $table->time('time_assigned');
            $table->string('url_route_sheet',500);

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
        Schema::dropIfExists('adm_hoja_ruta');
    }
}

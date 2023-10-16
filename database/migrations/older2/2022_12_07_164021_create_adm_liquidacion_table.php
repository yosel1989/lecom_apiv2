<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmLiquidacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_liquidacion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('id_tipo_liquidacion');
            $table->date('date')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->uuid('id_vehicle')->nullable();
            $table->uuid('id_personal')->nullable();
            $table->decimal('amount',10,2)->default(0);
            $table->string('observation',250)->nullable();
            $table->smallInteger('id_status')->default(1);
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
        Schema::dropIfExists('adm_liquidacion');
    }
}

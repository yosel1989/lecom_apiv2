<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmMotivoAnulacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_motivo_anulacion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',150);
            $table->uuid('id_client')->nullable();
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
        Schema::dropIfExists('adm_motivo_anulacion');
    }
}

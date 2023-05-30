<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_personal', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('personal_document',20);
            $table->date('birth_date')->nullable();
            $table->integer('id_status')->default(1);
            $table->uuid('id_personal_category');
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
        Schema::dropIfExists('adm_personal');
    }
}

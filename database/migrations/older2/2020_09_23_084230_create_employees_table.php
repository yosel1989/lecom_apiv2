<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',25);
            $table->string('address',50);
            $table->string('dni',15);
            $table->string('phone',15);
            $table->integer('code');
            $table->string('photo',50);
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_category');
            $table->uuid('id_license');
            $table->uuid('id_seg_vial');
            $table->uuid('id_gtu');
            $table->uuid('id_psicology_exam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

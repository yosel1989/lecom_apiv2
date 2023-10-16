<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdMachineTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_machine', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('imei',25);
            $table->integer('id_status');
            $table->uuid('id_client');
            $table->uuid('id_model');
            $table->integer('setPoint');
            $table->float('maxFuel',8,2);
            $table->string('sim');
            $table->integer('deleted')->default(0);

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
        Schema::dropIfExists('cold_machine');
    }
}

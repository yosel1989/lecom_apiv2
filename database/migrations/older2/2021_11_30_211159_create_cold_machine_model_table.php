<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdMachineModelTable extends Migration
{   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_machine_model', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',50);
            $table->string('shortname',20);
            $table->integer('id_type');
            $table->integer('code');
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
        Schema::dropIfExists('cold_machine_model');
    }
}

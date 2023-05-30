<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('bussiness_name',50);
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('ruc',15);
            $table->string('dni',8);
            $table->string('email',50);
            $table->string('address',100);
            $table->string('phone',15);
            $table->integer('type');
            $table->integer('deleted')->default(0);
            $table->uuid('id_parent_client')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

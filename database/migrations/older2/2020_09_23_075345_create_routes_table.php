<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',50);
            $table->longText('path');
            $table->decimal('kilometers',5,2);
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_terminal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}

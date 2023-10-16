<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',50);
            $table->string('short_name',10);
            $table->decimal('latituded',11,8);
            $table->decimal('longitude',11,8);
            $table->integer('radius');
            $table->integer('deleted');
            $table->uuid('id_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}

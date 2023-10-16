<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpParaderoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_paradero', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('name',100);
            $table->string('short_name',50)->nullable();
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
        Schema::dropIfExists('tp_paradero');
    }
}

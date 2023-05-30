<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('username',20)->unique();
            $table->string('password');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',50);
            $table->string('phone',15)->nullable();
            $table->integer('level');
            $table->integer('actived');
            $table->integer('deleted');
            $table->uuid('id_client')->nullable();
            $table->uuid('id_role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

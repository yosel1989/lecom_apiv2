<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColdMachineAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cold_machine_alert', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('code');
            $table->string('text');
            $table->string('description');

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
        Schema::dropIfExists('cold_machine_alert');
    }
}

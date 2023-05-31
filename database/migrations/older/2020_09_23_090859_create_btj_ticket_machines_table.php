<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtjTicketMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btj_ticket_machines', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('imei',30);
            $table->integer('deleted');
            $table->uuid('id_client');
            $table->uuid('id_vehicle');
<<<<<<< HEAD

            $table->timestamps();
=======
>>>>>>> a258fd9e965f7803e9af9a064bea820c21360515
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('btj_ticket_machines');
    }
}

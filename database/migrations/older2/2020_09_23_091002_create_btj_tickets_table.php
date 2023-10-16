<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtjTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btj_tickets', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('code',25);
            $table->dateTime('date');
            $table->decimal('latitude',11,8);
            $table->decimal('longitude',11,8);
            $table->integer('turn')->default(0);
            $table->integer('deleted')->default(0);
            $table->uuid('id_client');
            $table->uuid('id_vehicle');
            $table->uuid('id_ticket_machine');
            $table->uuid('id_ticket_price');
            $table->uuid('id_ticket_type');
            $table->string('personal_document', 25)->nullable();
            $table->date('reserved')->nullable();
            $table->date('id_route')->nullable();

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
        Schema::dropIfExists('btj_tickets');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBtjTicketPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btj_ticket_prices', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->integer('code');
            $table->decimal('price',5,2);
            $table->integer('actived');
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
        Schema::dropIfExists('btj_ticket_prices');
    }
}

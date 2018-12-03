<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContingencyEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contingency_event', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('contingency_id')->unsigned();
            $table->integer('event_id')->unsigned();

            $table->foreign('contingency_id')->references('id')->on('contingencies');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contingency_event');
    }
}

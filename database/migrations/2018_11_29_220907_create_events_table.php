<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned();
            $table->integer('colony_id')->unsigned();
            $table->text('address');
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->text('response')->nullable();
            $table->enum('status', ['Pendiente', 'Agendado', 'Realizado', 'Rechazado', 'No Realizado'])->default('Agendado');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('colony_id')->references('id')->on('colonies');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}

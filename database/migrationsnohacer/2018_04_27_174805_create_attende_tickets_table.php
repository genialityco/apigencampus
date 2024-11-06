<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attende_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->string('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('rols');
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
        Schema::dropIfExists('attende_tickets');
    }
}

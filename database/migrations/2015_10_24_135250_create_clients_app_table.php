<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_app', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clients_id')->unsigned();
            $table->foreign('clients_id')->references('id')->on('clients');
            $table->integer('aplication_id')->unsigned();
            $table->foreign('aplication_id')->references('id')->on('aplications');
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
        Schema::drop('clients_app');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->enum('status', ['D', 'U']);
            $table->string('ip');
            $table->integer('clients_app_id')->unsigned();
            $table->foreign('clients_app_id')->references('id')->on('clients_app');
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
        Schema::drop('otps');
    }
}

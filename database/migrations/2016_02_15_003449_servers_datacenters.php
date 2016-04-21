<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServersDatacenters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers_datacenters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active');
            $table->string('name');
            $table->string('details');
            $table->string('city');
            $table->string('country');
            $table->string('additional');
            $table->boolean('root');
            $table->boolean('vps');
            $table->boolean('webspace');
            $table->boolean('game');

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
        Schema::drop('servers_datacenters');
    }
}

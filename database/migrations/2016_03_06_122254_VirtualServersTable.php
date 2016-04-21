<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VirtualServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner');
            $table->string('container_id');
            $table->longText('plan');
            $table->integer('ordered');
            $table->string('os');
            $table->string('active');
            $table->string('hostname');
            $table->integer('status');
            $table->text('users');

            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vps');
    }
}

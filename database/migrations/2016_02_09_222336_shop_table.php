<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active');
            $table->longText('description');
            $table->string('title');
            $table->integer('stock');
            $table->decimal('price');
            $table->integer('sold');
            $table->integer('discount');
            $table->integer('created');
            $table->string('image');
            $table->string('leasetimes');
            $table->string('type');
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
        Schema::drop('shop_items');
    }
}

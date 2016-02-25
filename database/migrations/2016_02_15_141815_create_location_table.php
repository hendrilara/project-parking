<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('image')->onDelete('cascade');
            $table->integer('capacity_id')->unsigned()->index();
            //$table->foreign('image_id')->references('id')->on('image')->onDelete('cascade');
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('description');
            $table->float('price');
            $table->string('type');
            $table->float('longitude', 10,7);
            $table->float('latitude', 10, 7 );
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
        Schema::drop('location');
    }
}

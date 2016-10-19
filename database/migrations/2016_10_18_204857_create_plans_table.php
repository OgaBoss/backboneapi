<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->string('name');
            $table->string('premium');
            $table->string('cover_limit');
            $table->string('procedure')->nullable();
            $table->string('ailment')->nullable();
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}

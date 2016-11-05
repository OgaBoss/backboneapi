<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhisTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhis_trackers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->string('file_name')->default('');
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
        Schema::dropIfExists('nhis_trackers');
    }
}

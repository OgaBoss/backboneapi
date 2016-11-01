<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmoHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hmo_hospital', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos');
            $table->foreign('hospital_id')->references('id')->on('hospitals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hmo_hospital');
    }
}

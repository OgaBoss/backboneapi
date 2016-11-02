<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
            $table->integer('disease_id')->unsigned();

            $table->timestamps();

            $table->foreign('enrollee_id')->references('id')->on('enrollees');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('disease_id')->references('id')->on('diseases');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}

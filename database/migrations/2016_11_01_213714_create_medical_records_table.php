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
            $table->integer('hmo_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
            $table->string('description')->nullable();
            $table->string('referral_code');
            $table->string('drug_list')->nullable();
            $table->string('disease')->nullable();
            $table->boolean('claims_approval')->nullable();
            $table->boolean('claims_md_approval')->nullable();
            $table->boolean('md_approval')->nullable();
            $table->string('month')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('con')->nullable();
            $table->boolean('cf')->nullable();
            $table->boolean('ir')->nullable();
            $table->boolean('im')->nullable();
            $table->boolean('ih')->nullable();
            $table->boolean('is')->nullable();
            $table->boolean('rs1')->nullable();
            $table->boolean('rx2')->nullable();
            $table->boolean('rx3')->nullable();
            $table->boolean('rec')->nullable();
            $table->boolean('died')->nullable();
            $table->boolean('refill')->nullable();
            $table->boolean('transfer')->nullable();
            $table->timestamps();

            $table->foreign('enrollee_id')->references('id')->on('enrollees');
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
        Schema::dropIfExists('medical_records');
    }
}

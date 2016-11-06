<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referral_code');
            $table->integer('enrollee_id')->unsigned();
            $table->integer('hmo_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
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
        Schema::dropIfExists('referral_codes');
    }
}

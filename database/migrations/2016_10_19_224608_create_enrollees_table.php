<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('enrollees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->integer('dependent_id')->unsigned()->nullable();
            $table->integer('plan_id')->unsigned()->nullable();
            $table->string('generated_id');
            $table->string('first_name');
            $table->string('last_name', 100);
            $table->string('image_url')->nullable('');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('lg');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('dob');
            $table->boolean('status');
            $table->string('enrollee_type');
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos');
            $table->foreign('dependent_id')->references('id')->on('enrollees');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('plan_id')->references('id')->on('plans');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollees');
    }
}

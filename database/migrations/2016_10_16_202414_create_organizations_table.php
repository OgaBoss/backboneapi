<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('generated_id');
            $table->string('name', 100);
            $table->string('industry', 100);
            $table->string('phone');
            $table->string('email');
            $table->string('street_address');
            $table->string('lg');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos');
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
        Schema::dropIfExists('organizations');
    }
}

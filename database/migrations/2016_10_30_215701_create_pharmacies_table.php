<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('band_id')->unsigned();
            $table->string('generated_id');
            $table->string('name', 100);
            $table->string('bank');
            $table->string('account_number');
            $table->string('phone');
            $table->string('email');
            $table->string('street_address');
            $table->string('lg');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->timestamps();

            $table->foreign('band_id')->references('id')->on('bands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacies');
    }
}

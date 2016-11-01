<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmoPharmacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hmo_pharmacy', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('hmo_id')->unsigned();
            $table->integer('pharmacy_id')->unsigned();
            $table->timestamps();

            $table->foreign('hmo_id')->references('id')->on('hmos');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hmo_pharmacy');
    }
}

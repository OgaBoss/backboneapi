<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHospitalIdToEnrolleeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('enrollees', function (Blueprint $table) {
            $table->unsignedInteger('hospital_id')->nullable();
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
        //
        Schema::table('enrollees', function (Blueprint $table) {
            $table->dropForeign('enrollees_hospital_id_foreign');
        });
    }
}

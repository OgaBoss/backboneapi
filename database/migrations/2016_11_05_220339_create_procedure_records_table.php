<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_id')->unsigned();
            $table->integer('procedure_id')->unsigned();
            $table->boolean('claims_approval')->nullable();
            $table->boolean('claims_md_approval')->nullable();
            $table->boolean('md_approval')->nullable();
            $table->string('month')->nullable();
            $table->timestamps();

            $table->foreign('code_id')->references('id')->on('referral_codes');
            $table->foreign('procedure_id')->references('id')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedure_records');
    }
}

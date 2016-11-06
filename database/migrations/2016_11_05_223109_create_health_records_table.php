<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_records', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('code_id')->unsigned();
            $table->integer('procedure_id')->unsigned();
            $table->text('description')->nullable();
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

            $table->foreign('code_id')->references('id')->on('referral_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_records', function (Blueprint $table) {
            //
        });
    }
}

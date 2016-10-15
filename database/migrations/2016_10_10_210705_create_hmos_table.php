<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hmos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->default('');
            $table->string('street', 200)->default('');
            $table->string('email', 200)->unique();
            $table->string('phone_office', 200)->default('');
            $table->string('phone_mobile', 200)->unique();
            $table->string('city', 200)->default('');
            $table->string('state', 200)->default('');
            $table->string('country', 200)->default('');
            $table->string('lg', 200)->default('');
            $table->string('created_by', 200)->default('');
            $table->boolean('activated')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hmos');
    }
}

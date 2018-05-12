<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('student_id');
            $table->integer('promo');
            $table->string('td');
            $table->integer('promo_id')->unsigned();
            $table->foreign('promo_id')->references('promo_id')->on('promo');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Absence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence', function (Blueprint $table) {
            $table->increments('absence_id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('student_id')->on('student');
            $table->date('date','Y-m-d');
            //$table->date('beginning','Y-m-d H:i:s');
            //$table->date('end','Y-m-d H:i:s');
            //$table->integer('id_matiere');
            //$table->foreign('id_matiere')->references('id_matiere')->on('matiere');
            $table->boolean('justified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absence');
    }
}

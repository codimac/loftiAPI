<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Assignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->increments('assignment_id');
            $table->string('name');
            $table->string('description');
            $table->float('coefficient');
            $table->timestamps();
        });

        Schema::table('grade', function (Blueprint $table) {
            $table->foreign('assignment_id')->references('assignment_id')->on('assignment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade');
        Schema::dropIfExists('assignment');
    }
}

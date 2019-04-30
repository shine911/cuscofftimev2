<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('course_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->integer('type_id')->unsigned();

            //Relationship
            $table->foreign('type_id')->references('id')->on('course_types');
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->integer('amount');
            $table->bigInteger('cur_id')->unsigned();

            //Relationship
            $table->foreign('cur_id')->references('id')->on('courses');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

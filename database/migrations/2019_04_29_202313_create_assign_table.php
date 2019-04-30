<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('assignments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('sub_id');
                $table->integer('time_start');
                $table->integer('time_end');
                $table->string('month', 10);
                $table->unsignedBigInteger('class_id');
    
                $table->foreign('sub_id')->references('id')->on('subjects');
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('class_id')->references('id')->on('class_room');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            //
        });
    }
}

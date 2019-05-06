<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOffdays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offdays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('class_id');
            $table->timestamp('time_start')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('time_end')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('reason', 255);
            $table->integer('amount');
            $table->date('date');

            $table->foreign('class_id')->references('id')->on('class_room')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offdays');
    }
}

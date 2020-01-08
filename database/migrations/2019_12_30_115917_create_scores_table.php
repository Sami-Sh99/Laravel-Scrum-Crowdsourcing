<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_id')->unsigned();
            $table->integer('workshop_id')->unsigned();
            $table->enum('score',[1, 2, 3, 4, 5]);
            $table->timestamps();
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('participant_id')->references('user_id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facilitator_id')->unsigned();
            $table->string('key')->unique();
            $table->string('title');
            $table->integer('required_participants');
            $table->text('description');
            $table->boolean('is_closed')->default(false);   // set true if workshop can no longer accept participants
            $table->boolean('has_ended')->default(false);   // set true if workshop ended
            $table->timestamps();
            $table->foreign('facilitator_id')->references('id')->on('facilitators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}

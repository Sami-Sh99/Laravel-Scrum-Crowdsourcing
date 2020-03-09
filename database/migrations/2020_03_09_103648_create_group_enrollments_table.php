<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_enrollments', function (Blueprint $table) {
            $table->integer('participant_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->timestamps();
            $table->primary(['participant_id','group_id']);
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_enrollments');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('workshop_id');
            $table->timestamps();
            $table->primary(['participant_id','workshop_id']);
            $table->foreign('participant_id')->references('user_id')->on('participants');
            $table->foreign('workshop_id')->references('id')->on('workshops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_enrollments');
    }
}

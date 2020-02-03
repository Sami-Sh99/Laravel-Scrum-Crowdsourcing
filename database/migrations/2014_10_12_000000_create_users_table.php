<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('Fname');
            $table->string('Lname');
            $table->enum('role',['F', 'P', 'A']);       // 'P' for participant & 'F' for facilitator
            $table->string('photo_link')->default('unknown.png');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_deactivated')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // $table->index(['Fname', 'Lname']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

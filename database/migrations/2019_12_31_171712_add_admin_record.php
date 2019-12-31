<?php

use App\User;
use App\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'email' => 'admin@admin.com',
                'Fname'=>'Admin',
                'Lname'=>'Admin',
                'password' => Hash::make('admin123'),
                'role'=>'A',
            )
        );
        DB::table('admins')->insert(
            array(
                'id' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('role','A')->delete();
        Admin::where('id',1)->delete();
    }
}

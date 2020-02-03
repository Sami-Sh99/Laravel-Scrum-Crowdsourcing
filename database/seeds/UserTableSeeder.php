<?php

use Illuminate\Database\Seeder;
use App\Participant;
use App\Facilitator;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participants=array();
        $letter='a';
        for ($i = 1; $i < 7 ; $i++) { 
            array_push($participants,
                [
                    'Fname'=>'t'.$i,
                    'Lname'=>'testing',
                    'role'=>'P',
                    'password'=>'11111111',
                    'email'=> $letter.'@'.$letter.'.'.$letter
                ]);
            $letter++;
        }
        array_push($participants,
                [
                    'Fname'=>'F1',
                    'Lname'=>'testing',
                    'role'=>'F',
                    'password'=>'11111111',
                    'email'=> 'h@h.h'
                ]);
        $this->command->info('users Created!');
        foreach ($participants as $data) {
            $user = User::create([
                'Fname' => $data['Fname'],
                'Lname' => $data['Lname'],
                'role'  => $data['role'],
                'email' => $data['email'],
                'password' => Hash::make(trim($data['password'])),
                'is_verified'=>true,
            ]);
            if($data['role']=='P'){
                Participant::create([
                    'id'=>$user->id,
                ]);
            }
            else{
                Facilitator::create([
                    'id'=>$user->id,
                ]);
            }
        }
    }
}

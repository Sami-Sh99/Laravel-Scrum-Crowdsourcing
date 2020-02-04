<?php

use Illuminate\Database\Seeder;
use App\WorkshopEnrollment;
use App\Participant;
use App\Facilitator;
use App\Workshop;
use App\User;
use App\Card;

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
        $workshop=Workshop::create([
            'facilitator_id'=>8,
            'key'=>'www',
            'title'=>'The Seeded Workshop',
            'required_participants'=>6,
            'description'=>'This is a test workshop',
            'is_closed'=>false,
            'has_ended'=>false,
        ]);
        for ($i=2; $i < 8; $i++) { 
            $data=[
                'participant_id'=>$i,
                'workshop_id'=>$workshop->id
            ];
            WorkshopEnrollment::addWorkshopEnrollment($data);
        }

        for ($i=2; $i < 8; $i++) { 
            Card::createCard('1',$i,"Card #".$i);
        }
        
    }
}

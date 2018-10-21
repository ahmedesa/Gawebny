<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;


class UserSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::User( [
    		'name'=>'ahmed',
    		'email'=>'ahmed@ahmed.com',
            'password' => Hash::make('ahmed6120')  , // secret
            'remember_token' => str_random(10),
            'image' => '5bc6433b4406215397r19995index.jpg',
            'admin' => true ,

    ]);
    }
}

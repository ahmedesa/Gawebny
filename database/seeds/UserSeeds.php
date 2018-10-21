<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UserSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Country::User( [
    		'name'=>'ahmed',
    		'email'=>'ahmed@ahmed.com',
            'password' => Hash::make('ahmed6120')  , // secret
            'remember_token' => str_random(10),
            'image' => '5bc6433b4406215397r19995index.jpg',
            'admin' => true ,

    ]);
    }
}

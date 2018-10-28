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
    	User::create( [
    		'name'=>'admin',
    		'email'=>'admin@admin.com',
            'password' => Hash::make('admin')  , // secret
            'remember_token' => str_random(10),
            'admin' => true ,

    ]);
    }
}

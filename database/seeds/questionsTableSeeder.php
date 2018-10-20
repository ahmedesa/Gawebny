<?php

use Illuminate\Database\Seeder;

class questionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                factory(App\Question::class , 30)->create();
    }
}

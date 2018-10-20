<?php

use App\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  $this->call(questionsTableSeeder::class);
     //  $this->call(CategoryTableeeder::class);
       //$this->call(LanguageSeeds::class);
       //$this->call(CountryTableSeeds::class);
             $this->call(SettingTableSeeder::class);



   }
}

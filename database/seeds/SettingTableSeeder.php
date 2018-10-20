<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('setting')->insert(array(
    		array('name'=>'sitename_en'      ,'value'=>'Gawebny'),
    		array('name'=>'sitename_ar'      ,'value'=>'Gawebny'),
    		array('name'=>'dis_en'           ,'value'=>'Question Answer Website'),
            array('name'=>'dis_ar'           ,'value'=>'Question Answer Website'),
            array('name'=>'logo'          ,'value'=>'logo.png'),
            array('name'=>'email'         ,'value'=>'Gawebny@gmail.com'),
            array('name'=>'copyrights_en'    ,'value'=>'all right saved for Gawebny.com '),
            array('name'=>'copyrights_ar'     ,'value'=>'aaaaaaaaaaa'),
            array('name'=>'facebook'     ,'value'=>'aaaaaaaaaaa'),
            array('name'=>'twitter'     ,'value'=>'aaaaaaaaaaa'),
            array('name'=>'terms_en'     ,'value'=>'aaaaaaaaaaa'),
            array('name'=>'terms_ar'     ,'value'=>'aaaaaaaaaaa'),

        ));    }
    }

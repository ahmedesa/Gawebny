<?php

use Illuminate\Database\Seeder;

class CategoryTableeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('category')->insert(array(
    		array('name_en'=>'Programing'       ,'name_ar'=>'البرمجة'),
    		array('name_en'=>'Food'             ,'name_ar'=>'الاطعمة'),
    		array('name_en'=>'Economy'          ,'name_ar'=>'الاقتصاد'),
    		array('name_en'=>'Internet'         ,'name_ar'=>'الانترنت'),
    		array('name_en'=>'Environment'      ,'name_ar'=>'البيئة'),
    		array('name_en'=>'History'          ,'name_ar'=>'التاريخ'),
    		array('name_en'=>'Entertainment'    ,'name_ar'=>'ترفيهه'),
    		array('name_en'=>'Education'        ,'name_ar'=>'التعليم'),
    		array('name_en'=>'Technologies'     ,'name_ar'=>'التقنيات'),
    		array('name_en'=>'Cultures'         ,'name_ar'=>'الثقافة'),
    		array('name_en'=>'Computers'        ,'name_ar'=>'الحاسب الالي'),
    		array('name_en'=>'Sports'           ,'name_ar'=>'الرياضة'),
    		array('name_en'=>'Travel'           ,'name_ar'=>'السفر'),
    		array('name_en'=>'Politics'         ,'name_ar'=>'السياسة'),
    		array('name_en'=>'Health'           ,'name_ar'=>'الصخة'),
    		array('name_en'=>'Relationships'    ,'name_ar'=>'العلاقات'),
    		array('name_en'=>'Science'          ,'name_ar'=>'العلوم'),
    		array('name_en'=>'Art'              ,'name_ar'=>'الفن'),
    		array('name_en'=>'Books'            ,'name_ar'=>'كتب'),
            array('name_en'=>'Professions'      ,'name_ar'=>'المهن'),
            array('name_en'=>'Fashion'          ,'name_ar'=>'الموضة'),
            array('name_en'=>'Multimedia'       ,'name_ar'=>'الوسائط المتعددة'),
    		array('name_en'=>'Transportation'   ,'name_ar'=>'النقل'),


    	));
    }
}

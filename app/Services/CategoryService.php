<?php
namespace App\Services;
use App\Category;
use App\Question;
class CategoryService
{
   public  function percantage()
    {
        $all_question_count =   Question::all()->count();
        $all_category = Category::with('question')->withCount('question')->get();
        $result=[];
        foreach ($all_category as $cat) {
            $percentage =$cat->question_count/ $all_question_count * 100 ;
            $result[] = [
                'name'=>$cat->name_en , 'value'=>$percentage

            ];
        }
        return $result ;
    }
}

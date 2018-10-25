<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
	protected $table = 'category';
	protected $fillable =['name_en','name_ar'];
	protected static function boot()
	{
		parent::boot();
		static::deleting(function ($category) {
			$category->question->each->delete();
		});

	}
	public function question()
	{
		return	$this->belongsToMany(Question::class);
	}
	public function name()
	{
		if (App::getLocale() == "en") {
			return $this->name_en;
		}

		if (App::getLocale() == "ar") {
			return $this->name_ar;
		}
	}
	public static  function percantage()
	{
		$all_question_count = 	Question::all()->count();
		$all_category =	Self::with('question')->withCount('question')->get();
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

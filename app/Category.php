<?php

namespace App;

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
		return $this->{'name_'.App::getLocale()};
	}
}

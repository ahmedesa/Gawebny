<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SiteSetting extends Model
{
	protected $table = 'setting';
	protected $fillable = [
		'name' ,'value' ,  'type'

	];
	public  static function name()
	{
		if (App::getLocale() == "en") {
			return Self::where('name','sitename_en')->first()->value;
		}

		if (App::getLocale() == "ar") {
			return Self::where('name','sitename_ar')->first()->value;
		}
	}
	public  static function CopyRight()
	{
		if (App::getLocale() == "en") {
			return Self::where('name','copyrights_en')->first()->value;
		}

		if (App::getLocale() == "ar") {
			return Self::where('name','copyrights_ar')->first()->value;
		}
	}
		public  static function Terms()
	{
		if (App::getLocale() == "en") {
			return Self::where('name','terms_en')->first()->value;
		}

		if (App::getLocale() == "ar") {
			return Self::where('name','terms_ar')->first()->value;
		}
	}

}

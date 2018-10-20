<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Country extends Model
{
	protected $table = 'country';
	protected $fillable = [
		'name_ar', 'name_fr', 'name_en', 'code'
	];

	public $timestamps = false;
	public function name()
	{
		if (App::getLocale() == "en") {
			return $this->name_en;
		}

		if (App::getLocale() == "ar") {
			return $this->name_ar;
		}
	}
}

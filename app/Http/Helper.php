<?php

if (!function_exists('uplodeImg')) {
	function uplodeImg($image)
	{
		$fileName = uniqid().time().$image->getClientOriginalName();
		$image->move( base_path().'/public/Gawebny/img' , $fileName );
		return $fileName;
	}
}

if (!function_exists('CheckExistMention')) {

	function CheckExistMention($text = "") {
		$text = explode(" ", $text);
		$mention = array();
		foreach ($text as $word) {
			if (substr($word, 0, 1) == "@") {
				$mention= substr($word, 1);
			}
		}
		return $mention;
	}

}

if (!function_exists('Setting')) {

	function Setting($setting) {
		return App\SiteSetting::where('name',$setting)->first()->value;
	}
}


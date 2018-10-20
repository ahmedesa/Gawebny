<?php

namespace App\Helpers;

class Helper
{
	public static function uplodeImg($image)
	{
		$fileName = uniqid().time().$image->getClientOriginalName();
		$image->move( base_path().'/public/Gawebny/img' , $fileName );
		return $fileName;
	}

	public static function CheckExistMention($text = "") {
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
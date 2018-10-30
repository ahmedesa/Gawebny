<?php

use Pusher\Pusher;

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
if (!function_exists('SendNotification')) {

	function SendNotification($message ,$link ,$created_at ,$for_user_id) {
		
		$data['message']         = $message;
		$data['link']            = $link;
		$data['created_at']      = $created_at;
		$data['for_user_id']     = $for_user_id;


		$options = array(
			'cluster' => env('PUSHER_APP_CLUSTER'),
			'encrypted' => true
		);

		$pusher = new Pusher(
			'b948a1dfc499f62a98af',
			'9bf5496a37e72f62291d',
			'634318',
			$options
		);

		$pusher->trigger('Notify', 'send-message'.$for_user_id, $data);
	}
}

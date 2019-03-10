<?php

use App\SiteSetting;
use Illuminate\Support\Facades\App;
use Pusher\Pusher;

if (!function_exists('uplodeImg')) {
    function uplodeImg($image)
    {
        $fileName = uniqid() . time() . $image->getClientOriginalName();
        $image->move(base_path() . '/public/Gawebny/img', $fileName);
        return $fileName;
    }
}

if (!function_exists('CheckExistMention')) {
    function CheckExistMention($text = "")
    {
        $text = explode(" ", $text);
        $mention = [];
        foreach ($text as $word) {
            if (substr($word, 0, 1) == "@") {
                $mention = substr($word, 1);
            }
        }
        return $mention;
    }
}

if (!function_exists('Setting_')) {
    function Setting_($setting, $key)
    {
        if ($setting->where('name', $key)->first()) {
            return $setting->where('name', $key)->first()->value;
        }else{
            return $setting->where('name', $key.'_'.App::getLocale())->first()->value;
        }
    }
}
if (!function_exists('SendNotification')) {
    function SendNotification($message, $link, $created_at, $for_user_id)
    {

        $data['message'] = $message;
        $data['link'] = $link;
        $data['created_at'] = $created_at;
        $data['for_user_id'] = $for_user_id;

        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'send-message' . $for_user_id, $data);
    }
}
if (!function_exists('SearchLink')) {
    function SearchLink($type, $option = null, $main = false)
    {
        if ($main) {
            return route('search', array_except(request()->input(), [$type]));
        }
        return route('search', array_merge(array_except(request()->input(), [$type]), [$type => $option]));
    }
}

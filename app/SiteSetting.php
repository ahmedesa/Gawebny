<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $table = 'setting';
    protected $fillable = [
        'name', 'value', 'type',

    ];
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function () {
            self::flushCache();
        });
    }

    public static function flushCache()
    {
        Cache::forget('settings.all');
    }

    public static function getAllSettings()
    {
        return Cache::rememberForever('settings.all', function () {
            return self::all();
        });
    }


}

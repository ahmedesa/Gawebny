<?php

namespace App\Http\Middleware;

use App\SiteSetting;
use Closure;

class LanguageSwitcher
{
    public function handle($request, Closure $next)
    {	    	
    	$SiteDefaultLang = SiteSetting::getAllSettings()->where('name', 'lang')->first()->value;
        \App::setLocale(session('applocale') ?? $SiteDefaultLang);

        return $next($request);
    }
}
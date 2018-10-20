<?php

namespace App\Http\Middleware;

use Closure;

class LanguageSwitcher
{
    public function handle($request, Closure $next)
    {
        \App::setLocale(session('applocale') ?? 'en');

        return $next($request);
    }
}
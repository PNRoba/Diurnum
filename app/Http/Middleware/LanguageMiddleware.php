<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    const LOCALES = ['en', 'lv'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // retrieve selected language from the language cookie
        $lang = $request->cookie('language');
        if (!empty($lang)) {
            App::setLocale($lang);
        }
        else {
            $lang = $request->getPreferredLanguage(self::LOCALES);
            if (in_array($lang, self::LOCALES)) {
                 App::setLocale($lang);
            } 
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DetectUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supportedLocales = ['es', 'en', 'pt'];
        $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        $locale = session('locale', in_array($browserLocale, $supportedLocales) ? $browserLocale : config('app.locale'));

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}

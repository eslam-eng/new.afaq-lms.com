<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    { 
        if ($request->header('language')) {
            $language = $request->header('language');
        }elseif (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('panel.primary_language')) {
            $language = config('panel.primary_language');
        } 

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}

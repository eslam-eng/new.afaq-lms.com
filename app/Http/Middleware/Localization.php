<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = in_array($request->segment(1), ['en', 'ar']) ? $request->segment(1) : app()->getLocale();
        \App::setLocale($lang);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  App;
use  Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $session = Session::get('lang') ?Session::get('lang'): config('app.locale');
        $request->session()->put('lang', $session);
        App::setLocale($session);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
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
        // first way
        // \App::setLocale($request->language);

        // second way
        // if ($request->hasHeader("Accept-Language")) {
        //     /**
        //      * If Accept-Language header found then set it to the default locale
        //      */
        //     \App::setLocale($request->header("Accept-Language"));
        // }


        //third way
        if (! in_array($request->route('locale'), ['en', 'ar'])) {
                    abort(400);
                }
                \App::setLocale($request->route('locale'));
            
        return $next($request);
    }
}

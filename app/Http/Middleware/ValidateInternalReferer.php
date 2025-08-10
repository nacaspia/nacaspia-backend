<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateInternalReferer
{
    public function handle(Request $request, Closure $next)
    {
        $referer = $request->headers->get('referer');
        $appHost = parse_url(config('app.url'), PHP_URL_HOST);
        $refererHost = $referer ? parse_url($referer, PHP_URL_HOST) : null;

        if (!empty($referer) && $refererHost && $refererHost !== $appHost && ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete'))) {
           return redirect('/error');
        }

        return $next($request);
    }
}

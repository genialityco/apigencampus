<?php

namespace App\Http\Middleware;

use Closure;

class ForceJsonResponse
{
    public function handle($request, Closure $next)
    {
        //to force API validation to always return JSON and not some fucking redirect for webpages
        $request->headers->set('Accept', 'application/json');
        $request->headers->set('Content-Type', 'application/javascript');
        return $next($request);

    }

}

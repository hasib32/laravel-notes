<?php

namespace App\Http\Middleware;

use App\Helpers\ApiVersionHelper;
use Closure;

class VerifyApiVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $version = ApiVersionHelper::getVersion();

        ApiVersionHelper::validate($version);

        return $next($request);
    }
}

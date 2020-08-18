<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsEnableRoute
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, $feature)
    {
        $releaseFeature = config("release.{$feature}");

        if (!$releaseFeature['is_enabled']) {
            return \App::abort(404);
        }

        return $next($request);
    }
}

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
            $route = route($releaseFeature['back_to']);
            return redirect()->to($route);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class RequestLogger
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
        if (config('logging.enable_request_log')) {
            $this->writeLog($request);
        }

        return $next($request);
    }

    protected function writeLog($request)
    {
        \Log::debug(
            $request->method(),
            [
                'url' => $request->fullUrl(),
                'request' => $request->all(),
            ]
        );
    }
}

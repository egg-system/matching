<?php

namespace App\Http\Middleware;

use App\Models\Gym;
use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyGymOwner
{
    /**
     * ジムオーナーのみアクセス可能
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->user()->user_type === Gym::class) {
            return $next($request);
        }
        abort(403, __('Unauthorized'));
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Gym;
use Closure;

class OnlyGymOwner
{
    /**
     * トレーナーのみアクセス可能
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $login = $request->user();
        if (optional($login)->user_type === Gym::class) {
            return $next($request);
        }
        abort(403, __('Unauthorized'));
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Trainer;
use Closure;

class OnlyTrainer
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
        if (optional($login)->user_type === Trainer::class) {
            return $next($request);
        }
        return route('trainer.login');
    }
}

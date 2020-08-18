<?php

namespace App\Providers;

use App\Models\Offer;
use App\Observers\OfferObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('logging.enable_sql_log')) {
            $this->listenSqlLog();
        }
    }

    protected function listenSqlLog()
    {
        \DB::listen(function ($query) {
            \Log::debug('SQL', [
                'sql' => $query->sql,
                'bindings' => implode(',', $query->bindings),
                'time' => "$query->time ms",
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\App::isProduction() || \App::environment('staging')) {
            \URL::forceScheme('https');
        }

        Offer::observe(OfferObserver::class);

        // ジムとトレイナーでメールアドレスは重複可能なため、userTypeで切り分ける
        ResetPassword::$createUrlCallback = function ($notifiable, $token) {
            return url(route('password.reset', [
                'userType' => $notifiable->isGym ? 'gym' : 'trainer',
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]));
        };
    }
}

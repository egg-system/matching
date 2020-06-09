<?php

namespace App\Providers;

use App\Models\Gym;
use App\Models\Offer;
use App\Models\Trainer;
use App\Policies\OfferPolicy;
use App\Policies\TrainerPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Trainer::class => TrainerPolicy::class,
        Offer::class => OfferPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // トレーナーのみ許可
        Gate::define('trainer-only', function ($login) {
            return optional($login)->user_type === Trainer::class;
        });
        // ジムオーナーのみ許可
        Gate::define('gymowner-only', function ($login) {
            return optional($login)->user_type === Gym::class;
        });
    }
}

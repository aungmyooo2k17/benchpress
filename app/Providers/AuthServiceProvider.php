<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Models\Product;
use App\Models\Invitation;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProductPolicy;
use App\Policies\InvitationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Team::class => TeamPolicy::class,
        Product::class => ProductPolicy::class,
        Invitation::class => InvitationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

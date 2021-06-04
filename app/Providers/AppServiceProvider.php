<?php

namespace App\Providers;

use App\Actions\Teams\InviteMember;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Actions\InvitesMember;
use App\Actions\Teams\UpdateTeamInformation;
use App\Contracts\Actions\UpdatesTeamInformation;
use Emberfuse\Scorch\Providers\Traits\HasActions;

class AppServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The scorch action classes.
     *
     * @var array
     */
    protected $actions = [
        UpdatesTeamInformation::class => UpdateTeamInformation::class,
        InvitesMember::class => InviteMember::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerActions();
    }
}

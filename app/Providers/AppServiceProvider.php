<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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

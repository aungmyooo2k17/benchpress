<?php

namespace App\Providers;

use App\Products\ProductFactory;
use App\Actions\Teams\InviteMember;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Actions\InvitesMember;
use App\Actions\Teams\UpdateTeamInformation;
use App\Contracts\Actions\UpdatesTeamInformation;
use Emberfuse\Scorch\Providers\Traits\HasActions;
use App\Contracts\Products\ProductFactory as ProductFactoryContract;

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

        $this->registerProductFactory();
    }

    /**
     * Register product factory.
     *
     * @return void
     */
    protected function registerProductFactory(): void
    {
        $this->app->singleton(ProductFactoryContract::class, ProductFactory::class);
    }
}

<?php

namespace EolabsIo\PinterestApi;

use EolabsIo\PinterestApi\PinterestApi;
use Illuminate\Support\ServiceProvider;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Command\ListAdsCommand;
use EolabsIo\PinterestApi\Domain\AdAccounts\Command\AdInsightsCommand;
use EolabsIo\PinterestApi\Domain\AdAccounts\Command\ListAdGroupsCommand;
use EolabsIo\PinterestApi\Domain\AdAccounts\Providers\AdAccountsServiceProvider;

class PinterestApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (PinterestApi::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/pinterestApi'),
            ], 'pinterest-api-migrations');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('pinterest-api.php'),
            ], 'pinterest-api-api-config');

            // Registering package commands.
            $this->commands([
                AdInsightsCommand::class,
                ListAdsCommand::class,
                ListAdGroupsCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'pinterest-api');

        $this->app->register(AdAccountsServiceProvider::class);

        // Register the main class to use with the facade
        $this->app->singleton(AdAnalytics::class, function () {
            return new AdAnalytics();
        });

        $this->app->singleton(AdAccountAnalytics::class, function () {
            return new AdAccountAnalytics();
        });

        $this->app->singleton(ListAds::class, function () {
            return new ListAds();
        });

        $this->app->singleton(ListAdGroups::class, function () {
            return new ListAdGroups();
        });
    }
}

<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Providers;

use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Listeners\FetchAdAnalyticsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AdAccountsServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchAdAnalytics::class => [
            FetchAdAnalyticsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

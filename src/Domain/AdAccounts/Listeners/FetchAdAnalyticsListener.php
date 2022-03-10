<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Listeners;

use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchAdAnalytics;

class FetchAdAnalyticsListener
{
    public function handle(FetchAdAnalytics $event)
    {
        $adAnalytics = $event->adAnalytics;
        PerformFetchAdAnalytics::dispatch($adAnalytics)->onQueue('ad-insights');
    }
}

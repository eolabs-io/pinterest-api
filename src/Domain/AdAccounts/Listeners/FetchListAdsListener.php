<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Listeners;

use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchListAds;

class FetchListAdsListener
{
    public function handle(FetchListAds $event)
    {
        $listAds = $event->listAds;
        PerformFetchListAds::dispatch($listAds)->onQueue('list-ads');
    }
}

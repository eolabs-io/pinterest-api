<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Listeners;

use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchListAdGroups;

class FetchListAdGroupsListener
{
    public function handle(FetchListAdGroups $event)
    {
        $listAdGroups = $event->listAdGroups;
        PerformFetchListAdGroups::dispatch($listAdGroups)->onQueue('list-ad-groups');
    }
}

<?php

namespace EolabsIo\PinterestApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;

/**
 * @see EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics
 */
class PinterestListAds extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ListAds::class;
    }
}

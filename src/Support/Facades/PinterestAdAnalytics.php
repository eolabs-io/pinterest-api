<?php

namespace EolabsIo\PinterestApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics;

/**
 * @see EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics
 */
class PinterestAdAnalytics extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdAnalytics::class;
    }
}

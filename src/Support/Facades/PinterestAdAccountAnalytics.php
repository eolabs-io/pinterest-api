<?php

namespace EolabsIo\PinterestApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountAnalytics;

/**
 * @see EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics
 */
class PinterestAdAccountAnalytics extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdAccountAnalytics::class;
    }
}

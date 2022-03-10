<?php

namespace EolabsIo\PinterestApi\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;

/**
 * @see EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics
 */
class PinterestListAdGroups extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ListAdGroups::class;
    }
}

<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;

class FetchListAdGroups
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups */
    public $listAdGroups;

    public function __construct(ListAdGroups $listAdGroups)
    {
        $this->listAdGroups = $listAdGroups;
    }
}

<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;

class FetchListAds
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\ListAds */
    public $listAds;

    public function __construct(ListAds $listAds)
    {
        $this->listAds = $listAds;
    }
}

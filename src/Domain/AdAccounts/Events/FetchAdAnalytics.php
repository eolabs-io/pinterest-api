<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics;

class FetchAdAnalytics
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics */
    public $adAnalytics;

    public function __construct(AdAnalytics $adAnalytics)
    {
        $this->adAnalytics = $adAnalytics;
    }
}

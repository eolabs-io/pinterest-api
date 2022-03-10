<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts;

use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountCore;
use EolabsIo\PinterestApi\Domain\AdAccounts\Concerns\InteractsWithAdAnalytics;

class AdAnalytics extends AdAccountCore
{
    use InteractsWithAdAnalytics;

    public function getEndpoint(): string
    {
        $version = $this->getVersion();
        $adAccountId = $this->getAdAccountId();

        return "/{$version}/ad_accounts/{$adAccountId}/ads/analytics";
    }

    public function getParameters(): array
    {
        return $this->getAdAnalyticParameters();
    }
}

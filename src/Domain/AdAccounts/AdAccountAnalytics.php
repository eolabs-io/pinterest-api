<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts;

use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountCore;
use EolabsIo\PinterestApi\Domain\AdAccounts\Concerns\InteractsWithAdAccountAnalytics;

class AdAccountAnalytics extends AdAccountCore
{
    use InteractsWithAdAccountAnalytics;

    public function getEndpoint(): string
    {
        $version = $this->getVersion();
        $adAccountId = $this->getAdAccountId();

        return "/{$version}/ad_accounts/{$adAccountId}/analytics";
    }

    public function getParameters(): array
    {
        return $this->getAdAccountAnalyticParameters();
    }
}

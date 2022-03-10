<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts;

use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountCore;
use EolabsIo\PinterestApi\Domain\AdAccounts\Concerns\InteractsWithListAds;

class ListAds extends AdAccountCore
{
    use InteractsWithListAds;

    public function getEndpoint(): string
    {
        $version = $this->getVersion();
        $adAccountId = $this->getAdAccountId();

        return "/{$version}/ad_accounts/{$adAccountId}/ads";
    }

    public function getParameters(): array
    {
        return $this->getListAdsParameters();
    }
}

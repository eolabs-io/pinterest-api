<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts;

use EolabsIo\PinterestApi\Domain\AdAccounts\AdAccountCore;
use EolabsIo\PinterestApi\Domain\AdAccounts\Concerns\InteractsWithListAdGroups;

class ListAdGroups extends AdAccountCore
{
    use InteractsWithListAdGroups;

    public function getEndpoint(): string
    {
        $version = $this->getVersion();
        $adAccountId = $this->getAdAccountId();

        return "/{$version}/ad_accounts/{$adAccountId}/ad_groups";
    }

    public function getParameters(): array
    {
        return $this->getListAdGroupsParameters();
    }
}

<?php

namespace EolabsIo\PinterestApi\Tests\Concerns;

use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;
use EolabsIo\PinterestApi\Tests\Factories\ListAdGroupsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestListAdGroups;

trait CreatesListAdGroups
{
    public function createListAdGroups()
    {
        ListAdGroupsFactory::new()->fakeListAdGroupsResponse();

        return $this->getDefaultListAdGroups();
    }

    private function getDefaultListAdGroups(): ListAdGroups
    {
        $campaignIds = [
          '123456789',
          '234567890',
          '987654321',
        ];

        $adGroupIds = [
          '7212674017',
          '7212674076',
          '7212674077',
          '7231766955'
        ];

        $entityStatuses = [
            'ACTIVE',
            'PAUSED',
            'ARCHIVED'
        ];

        $pageSize = 100;

        $order = 'ASCENDING';

        return PinterestListAdGroups::withCampaignIds($campaignIds)
                                ->withAdGroupIds($adGroupIds)
                                ->withEntityStatuses($entityStatuses)
                                ->withPageSize($pageSize)
                                ->withOrder($order)
                                ->withTranslateInterestsToNames(false);
    }
}

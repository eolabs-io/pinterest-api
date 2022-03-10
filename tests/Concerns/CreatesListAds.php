<?php

namespace EolabsIo\PinterestApi\Tests\Concerns;

use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;
use EolabsIo\PinterestApi\Tests\Factories\ListAdsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestListAds;

trait CreatesListAds
{
    public function createListAds()
    {
        ListAdsFactory::new()->fakeListAdsResponse();

        return $this->getDefaultListAds();
    }

    private function getDefaultListAds(): ListAds
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

        $adIds = [
          '687212674017',
          '687212674076',
          '687212674077',
          '687231766955'
        ];

        $entityStatuses = [
            'ACTIVE',
            'PAUSED',
            'ARCHIVED'
        ];

        $pageSize = 100;

        $order = 'ASCENDING';

        return PinterestListAds::withCampaignIds($campaignIds)
                                ->withAdGroupIds($adGroupIds)
                                ->withAdIds($adIds)
                                ->withEntityStatuses($entityStatuses)
                                ->withPageSize($pageSize)
                                ->withOrder($order);
    }
}

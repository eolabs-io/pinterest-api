<?php

namespace EolabsIo\PinterestApi\Tests\Concerns;

use Illuminate\Support\Carbon;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics;
use EolabsIo\PinterestApi\Tests\Factories\AdAnalyticsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestAdAnalytics;

trait CreatesAdAnalytics
{
    public function createAdAnalytics()
    {
        AdAnalyticsFactory::new()->fakeAdAnalyticsResponse();

        return $this->getDefaultAdAnalytics();
    }

    private function getDefaultAdAnalytics(): AdAnalytics
    {
        $startDate = Carbon::create(2022, 1, 1, 12);
        $endDate = Carbon::create(2022, 3, 1, 12);
        $adIds = [
          '687212674017',
          '687212674076',
          '687212674077',
          '687231766955'
        ];
        $columns = [
          'AD_ACCOUNT_ID',
          'CAMPAIGN_ID',
          'CAMPAIGN_NAME',
          'AD_GROUP_ID',
          'AD_ID',
          'SPEND_IN_DOLLAR',
          'TOTAL_CLICKTHROUGH'
        ];

        $granularity = 'DAY';

        return PinterestAdAnalytics::withStartDate($startDate)
            ->withEndDate($endDate)
            ->withAdIds($adIds)
            ->withColumns($columns)
            ->withGranularity($granularity);
    }
}

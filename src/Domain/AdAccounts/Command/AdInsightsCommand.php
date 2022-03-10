<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\PinterestApi\Support\Facades\PinterestListAds;
use EolabsIo\PinterestApi\Support\Facades\PinterestAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchAdAnalytics;

class AdInsightsCommand extends Command
{
    protected $signature = 'pinterest-api:ad-insights
                            {--ad-ids=* : List of Ad Ids to use to filter the results.}
                            {--end-date= : The end date for the report.}
                            {--start-date= : The start date for the report.}';

    protected $description = 'Gets Ad Insight Report from the Pinterest API';


    public function handle()
    {
        $this->info('Getting Ad Insight Report from the Pinterest API...');

        $adIds = $this->getAdIds();
        $endDate = Carbon::create($this->option('end-date'));
        $startDate = Carbon::create($this->option('start-date'));
        $columns = $this->getColumns();
        $granularity = 'DAY';

        foreach (array_chunk($adIds, 100) as $ids) {
            $pinterestAdAnalytics = PinterestAdAnalytics::withStartDate($startDate)
                        ->withEndDate($endDate)
                        ->withAdIds($ids)
                        ->withColumns($columns)
                        ->withGranularity($granularity);

            FetchAdAnalytics::dispatch($pinterestAdAnalytics);
        }
    }

    public function getColumns(): array
    {
        return [
            'AD_ACCOUNT_ID',
            'CAMPAIGN_ID',
            'CAMPAIGN_NAME',
            'AD_GROUP_ID',
            'AD_ID',
            'SPEND_IN_DOLLAR',
            'TOTAL_CLICKTHROUGH',
        ];
    }

    public function getAdIds(): array
    {
        // Use user provided ids
        $adIds = $this->option('ad-ids');

        if ($adIds) {
            return $adIds;
        }

        // Find all active ads when non are provided
        $ads = PinterestListAds::withEntityStatuses(['ACTIVE'])->fetch();
        $items = data_get($ads, 'items', []);

        return array_column($items, 'id');
    }
}

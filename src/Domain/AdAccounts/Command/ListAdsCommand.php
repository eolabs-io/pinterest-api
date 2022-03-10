<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Command;

use Illuminate\Console\Command;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAds;

class ListAdsCommand extends Command
{
    protected $signature = 'pinterest-api:list-ads
                            {--campaign-ids=* : List of Campaign Ids to use to filter the results.}
                            {--ad-group-ids=* : List of Ad group Ids to use to filter the results.}
                            {--ad-ids=* : List of Ad Ids to use to filter the results.}
                            {--entity-statuses=* : Entity status.}
                            {--page-size= : Maximum number of items to include in a single page of the response.}
                            {--order= : The order in which to sort the items returned: ASCENDING or DESCENDING.}';

    protected $description = 'Gets Ads from the Pinterest API';


    public function handle()
    {
        $this->info('Getting Ads from the Pinterest API...');

        $campaignIds = $this->option('campaign-ids');
        $adGroupIds = $this->option('ad-group-ids');
        $adIds = $this->option('ad-ids');
        $entityStatuses = $this->option('entity-statuses');
        $pageSize = $this->option('page-size');
        $order = $this->option('order');


        $pinterestListAds = new ListAds;

        if ($campaignIds) {
            $pinterestListAds->withCampaignIds($campaignIds);
        }

        if ($adGroupIds) {
            $pinterestListAds->withAdGroupIds($adGroupIds);
        }

        if ($adIds) {
            $pinterestListAds->withAdIds($adIds);
        }

        if ($entityStatuses) {
            $pinterestListAds->withEntityStatuses($entityStatuses);
        }

        if ($pageSize) {
            $pinterestListAds->withPageSize($pageSize);
        }

        if ($order) {
            $pinterestListAds->withOrder($order);
        }


        FetchListAds::dispatch($pinterestListAds);
    }
}

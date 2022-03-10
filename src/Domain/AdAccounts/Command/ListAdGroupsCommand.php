<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Command;

use Illuminate\Console\Command;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAdGroups;

class ListAdGroupsCommand extends Command
{
    protected $signature = 'pinterest-api:list-ad-groups
                            {--campaign-ids=* : List of Campaign Ids to use to filter the results.}
                            {--ad-group-ids=* : List of Ad group Ids to use to filter the results.}
                            {--entity-statuses=* : Entity status.}
                            {--page-size= : Maximum number of items to include in a single page of the response.}
                            {--order= : The order in which to sort the items returned: ASCENDING or DESCENDING.}';

    protected $description = 'Gets Ad Groups from the Pinterest API';


    public function handle()
    {
        $this->info('Getting Ad Groups from the Pinterest API...');

        $campaignIds = $this->option('campaign-ids');
        $adGroupIds = $this->option('ad-group-ids');
        $entityStatuses = $this->option('entity-statuses');
        $pageSize = $this->option('page-size');
        $order = $this->option('order');


        $pinterestListAdGroups = new ListAdGroups;

        if ($campaignIds) {
            $pinterestListAdGroups->withCampaignIds($campaignIds);
        }

        if ($adGroupIds) {
            $pinterestListAdGroups->withAdGroupIds($adGroupIds);
        }

        if ($entityStatuses) {
            $pinterestListAdGroups->withEntityStatuses($entityStatuses);
        }

        if ($pageSize) {
            $pinterestListAdGroups->withPageSize($pageSize);
        }

        if ($order) {
            $pinterestListAdGroups->withOrder($order);
        }


        FetchListAdGroups::dispatch($pinterestListAdGroups);
    }
}

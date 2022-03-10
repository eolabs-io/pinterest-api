<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Actions;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;
use EolabsIo\PinterestApi\Domain\AdAccounts\Models\CostInsight;
use EolabsIo\PinterestApi\Domain\Shared\Actions\BasePersistAction;

class PersistAdAnalyticsAction extends BasePersistAction
{
    public function __construct($list)
    {
        $this->list = $list;
    }

    public function getKey(): string
    {
        return '';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new CostInsight);

        $attributes = [
            'ad_account_id' => data_get($list, 'AD_ACCOUNT_ID'),
            'ad_id' => data_get($list, 'AD_ID'),
            'campaign_id' => data_get($list, 'CAMPAIGN_ID'),
            'ad_group_id' => data_get($list, 'AD_GROUP_ID'),
            'date' => data_get($list, 'DATE'),
        ];

        $costInsight = CostInsight::updateOrCreate($attributes, $values);

        $this->associateCampaign($list);
        $this->associateAdGroup($list);
        $this->associateAd($list);

        return $costInsight;
    }

    public function associateCampaign($list)
    {
        $values = [
            'id' => data_get($list, 'CAMPAIGN_ID'),
            'name' => data_get($list, 'CAMPAIGN_NAME'),
        ];
        $attributes = [
            'id' => data_get($list, 'CAMPAIGN_ID')
        ];

        Campaign::firstOrCreate($attributes, $values);
    }

    public function associateAdGroup($list)
    {
        $values = [
            'id' => data_get($list, 'AD_GROUP_ID'),
            'name' => data_get($list, 'AD_GROUP_NAME'),
        ];
        $attributes = [
            'id' => data_get($list, 'AD_GROUP_ID')
        ];

        AdGroup::firstOrCreate($attributes, $values);
    }

    public function associateAd($list)
    {
        $values = [
            'id' => data_get($list, 'AD_ID'),
            'name' => data_get($list, 'AD_NAME'),
        ];
        $attributes = [
            'id' => data_get($list, 'AD_ID')
        ];

        Ad::firstOrCreate($attributes, $values);
    }

    public function customFormats($element): string
    {
        $element = Str::replaceFirst('spend', 'SPEND_IN_DOLLAR', $element);

        return Str::upper($element);
    }
}

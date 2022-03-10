<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Concerns;

trait InteractsWithListAds
{
    /** @var array */
    private $listAdsParameters = [];


    public function withCampaignIds(array $campaignIds): self
    {
        $this->listAdsParameters['campaign_ids'] = implode(',', $campaignIds);

        return $this;
    }


    public function withAdGroupIds(array $adGroupIds): self
    {
        $this->listAdsParameters['ad_group_ids'] = implode(',', $adGroupIds);

        return $this;
    }


    public function withAdIds(array $ids): self
    {
        $this->listAdsParameters['ad_ids'] = implode(',', $ids);

        return $this;
    }


    public function withEntityStatuses(array $entityStatuses): self
    {
        $this->listAdsParameters['entity_statuses'] = implode(',', $entityStatuses);

        return $this;
    }


    public function withOrder(string $order): self
    {
        $this->listAdsParameters['order'] = $order;

        return $this;
    }


    public function getListAdsParameters(): array
    {
        return $this->listAdsParameters;
    }
}

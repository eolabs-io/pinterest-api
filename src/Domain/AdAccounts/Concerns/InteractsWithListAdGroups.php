<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Concerns;

trait InteractsWithListAdGroups
{
    /** @var array */
    private $listAdGroupsParameters = [];


    public function withCampaignIds(array $campaignIds): self
    {
        $this->listAdGroupsParameters['campaign_ids'] = implode(',', $campaignIds);

        return $this;
    }


    public function withAdGroupIds(array $adGroupIds): self
    {
        $this->listAdGroupsParameters['ad_group_ids'] = implode(',', $adGroupIds);

        return $this;
    }


    public function withEntityStatuses(array $entityStatuses): self
    {
        $this->listAdGroupsParameters['entity_statuses'] = implode(',', $entityStatuses);

        return $this;
    }


    public function withOrder(string $order): self
    {
        $this->listAdGroupsParameters['order'] = $order;

        return $this;
    }


    public function withTranslateInterestsToNames(bool $translateInterestsToNames): self
    {
        $this->listAdGroupsParameters['translate_interests_to_names'] = $translateInterestsToNames;

        return $this;
    }


    public function getlistAdGroupsParameters(): array
    {
        return $this->listAdGroupsParameters;
    }
}

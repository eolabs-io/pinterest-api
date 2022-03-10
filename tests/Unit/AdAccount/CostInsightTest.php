<?php

namespace EolabsIo\PinterestApi\Tests\Unit\AdAccount;

use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use EolabsIo\PinterestApi\Tests\Unit\BaseModelTest;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;
use EolabsIo\PinterestApi\Domain\AdAccounts\Models\CostInsight;

class CostInsightTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CostInsight::class;
    }

    /** @test */
    public function it_has_campaign_relationship()
    {
        $campaign = Campaign::factory()->create();
        $costInsight = CostInsight::factory()->create(['campaign_id' => $campaign->id]);

        $this->assertArraysEqual($campaign->toArray(), $costInsight->campaign->toArray());
    }

    /** @test */
    public function it_has_ad_group_relationship()
    {
        $adGroup = AdGroup::factory()->create();
        $costInsight = CostInsight::factory()->create(['ad_group_id' => $adGroup->id]);

        $this->assertArraysEqual($adGroup->toArray(), $costInsight->adGroup->toArray());
    }

    /** @test */
    public function it_has_ad_relationship()
    {
        $ad = Ad::factory()->create();
        $costInsight = CostInsight::factory()->create(['ad_id' => $ad->id]);

        $this->assertArraysEqual($ad->toArray(), $costInsight->ad->toArray());
    }
}

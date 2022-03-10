<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Models\CostInsight;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessAdAnalyticsResponse;

class ProcessAdAnalyticsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesAdAnalytics;


    protected function setUp(): void
    {
        parent::setUp();

        $adAnalytics = $this->createAdAnalytics();
        $results = $adAnalytics->fetch();

        (new ProcessAdAnalyticsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_insights_response()
    {
        $costInsight = CostInsight::first();

        expect($costInsight->ad_account_id)->toBe('349256412243');
        expect($costInsight->campaign_id)->toBe('226745517864');
        expect($costInsight->ad_group_id)->toBe('6807070816130');
        expect($costInsight->ad_id)->toBe('887291760950');
        expect($costInsight->date)->toBe('2022-02-19');
        expect($costInsight->total_clickthrough)->toBe('13');
        expect($costInsight->spend)->toBe('11.701079');

        $this->assertCampaign();
        $this->assertAdGroup();
        $this->assertAd();
    }

    public function assertCampaign()
    {
        $campaign = Campaign::first();

        expect($campaign->id)->toBe('226745517864');
        expect($campaign->name)->toBe('2022-02-18 19:38 UTC | Consideration | Amazon Attribution');
    }

    public function assertAdGroup()
    {
        $adGroup = AdGroup::first();

        expect($adGroup->id)->toBe('6807070816130');
        expect($adGroup->name)->toBeNull();
    }

    public function assertAd()
    {
        $ad = Ad::first();

        expect($ad->id)->toBe('887291760950');
        expect($ad->name)->toBeNull();
    }
}

<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Factories\ListAdsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestListAds;

class ListAdsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        ListAdsFactory::new()->fakeListAdsResponse();

        $campaignIds = [626735565838, 524735265858];
        $adGroupIds = [2680059592705, 4526005959702];
        $adIds = [687195134316, 58737668714316];
        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $pageSize = 50;
        $order = "ASCENDING";

        PinterestListAds::withCampaignIds($campaignIds)
            ->withAdGroupIds($adGroupIds)
            ->withAdIds($adIds)
            ->withEntityStatuses($entityStatuses)
            ->withPageSize($pageSize)
            ->withOrder($order)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/ads") &&
                   $request->method() == "GET" &&
            // Headers
                    $request->hasHeader('Authorization', 'Bearer pina|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
            // Body
                    $request['campaign_ids'] == '626735565838,524735265858' &&
                    $request['ad_group_ids'] == '2680059592705,4526005959702' &&
                    $request['ad_ids'] == '687195134316,58737668714316' &&
                    $request['entity_statuses'] == 'ACTIVE,PAUSED' &&
                    $request['page_size'] == 50 &&
                    $request['order'] == 'ASCENDING';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        ListAdsFactory::new()->fakeListAdsResponse();

        $campaignIds = [626735565838, 524735265858];
        $adGroupIds = [2680059592705, 4526005959702];
        $adIds = [687195134316, 58737668714316];
        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $pageSize = 50;
        $order = "ASCENDING";

        $response = PinterestListAds::withCampaignIds($campaignIds)
            ->withAdGroupIds($adGroupIds)
            ->withAdIds($adIds)
            ->withEntityStatuses($entityStatuses)
            ->withPageSize($pageSize)
            ->withOrder($order)
            ->fetch();

        $ad = $response['items'][0];

        expect($ad['ad_group_id'])->toBe('2680059592705');
        expect($ad['campaign_id'])->toBe('626735565838');
        expect($ad['pin_id'])->toBe('394205773611545468');
    }

    /** @test */
    public function it_gets_the_correct_response_with_pagination()
    {
        ListAdsFactory::new()->fakeListAdsResponseWithPagination();


        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $order = "ASCENDING";

        $pinterestListAds = PinterestListAds::withEntityStatuses($entityStatuses)
                ->withOrder($order);

        $paginationResponse = $pinterestListAds->fetch();

        $this->assertTrue($pinterestListAds->hasPagination());

        $response = $pinterestListAds->fetch();

        // dd($response);
        $adId1 = data_get($response, 'items.0.id');
        $adId2 = data_get($paginationResponse, 'items.0.id');

        expect($adId1)->toBe('687195134316');
        expect($adId2)->toBe('487191134333');

        $this->assertCount(2, $paginationResponse['items']);
        $this->assertCount(1, $response['items']);

        $this->assertSentReportWithCursorId();
    }

    public function assertSentReportWithCursorId()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[3][0];

        $this->assertTrue(
            Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/ads") &&
               $request['bookmark'] == 'wwfDEsMiwzfDB8ZmNlNjY3NjBhZDZlODExYjhkYzQ1NDZhM2E4M2Y1ZTI1MjJmMjQ3NGVhMjY1OWU0'
        );
    }
}

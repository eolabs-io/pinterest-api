<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Factories\ListAdGroupsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestListAdGroups;

class ListAdGroupsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        ListAdGroupsFactory::new()->fakeListAdGroupsResponse();

        $campaignIds = [626735565838, 524735265858];
        $adGroupIds = [2680059592705, 4526005959702];
        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $pageSize = 50;
        $order = "ASCENDING";

        PinterestListAdGroups::withCampaignIds($campaignIds)
            ->withAdGroupIds($adGroupIds)
            ->withEntityStatuses($entityStatuses)
            ->withPageSize($pageSize)
            ->withOrder($order)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/ad_groups") &&
                   $request->method() == "GET" &&
            // Headers
                    $request->hasHeader('Authorization', 'Bearer pina|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
            // Body
                    $request['campaign_ids'] == '626735565838,524735265858' &&
                    $request['ad_group_ids'] == '2680059592705,4526005959702' &&
                    $request['entity_statuses'] == 'ACTIVE,PAUSED' &&
                    $request['page_size'] == 50 &&
                    $request['order'] == 'ASCENDING';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        ListAdGroupsFactory::new()->fakeListAdGroupsResponseWithPagination();

        $campaignIds = [626735565838, 524735265858];
        $adGroupIds = [2680059592705, 4526005959702];
        $adIds = [687195134316, 58737668714316];
        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $pageSize = 50;
        $order = "ASCENDING";

        $response = PinterestListAdGroups::withCampaignIds($campaignIds)
            ->withAdGroupIds($adGroupIds)
            ->withEntityStatuses($entityStatuses)
            ->withPageSize($pageSize)
            ->withOrder($order)
            ->fetch();

        $ad = $response['items'][0];

        expect($ad['id'])->toBe('7680360708726');
        expect($ad['campaign_id'])->toBe('626736533506');
    }

    /** @test */
    public function it_gets_the_correct_response_with_pagination()
    {
        ListAdGroupsFactory::new()->fakeListAdGroupsResponseWithPagination();


        $entityStatuses = ['ACTIVE', 'PAUSED'];
        $order = "ASCENDING";

        $pinterestListAds = PinterestListAdGroups::withEntityStatuses($entityStatuses)
                ->withOrder($order);

        $paginationResponse = $pinterestListAds->fetch();

        $this->assertTrue($pinterestListAds->hasPagination());

        $response = $pinterestListAds->fetch();

        // dd($response);
        $adId1 = data_get($response, 'items.0.id');
        $adId2 = data_get($paginationResponse, 'items.0.id');

        expect($adId1)->toBe('2680060704746');
        expect($adId2)->toBe('7680360708726');

        $this->assertCount(1, $paginationResponse['items']);
        $this->assertCount(1, $response['items']);

        $this->assertSentReportWithCursorId();
    }

    public function assertSentReportWithCursorId()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[3][0];

        $this->assertTrue(
            Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/ad_groups") &&
               $request['bookmark'] == 'fjadsfjlasdurewidsflajsdfbnfdnbdfanbfdasb'
        );
    }
}

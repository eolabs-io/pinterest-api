<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Factories\AdAnalyticsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestAdAnalytics;

class AdAnalyticsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        AdAnalyticsFactory::new()->fakeAdAnalyticsResponse();

        $startDate = Carbon::create(2020, 2, 24, 12);
        $endDate = Carbon::create(2020, 3, 24, 12);
        $adIds = ['2291326454', '3422913264545'];
        $columns = ['AD_ACCOUNT_ID', 'CAMPAIGN_ID'];
        $granularity = 'DAY';

        PinterestAdAnalytics::withStartDate($startDate)
            ->withEndDate($endDate)
            ->withAdIds($adIds)
            ->withColumns($columns)
            ->withGranularity($granularity)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/ads/analytics") &&
                   $request->method() == "GET" &&
            // Headers
                    $request->hasHeader('Authorization', 'Bearer pina|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
            // Body
                    $request['start_date'] == '2020-02-24' &&
                    $request['end_date'] == '2020-03-24' &&
                    $request['ad_ids'] == '2291326454,3422913264545' &&
                    $request['columns'] == 'AD_ACCOUNT_ID,CAMPAIGN_ID' &&
                    $request['granularity'] == 'DAY';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        AdAnalyticsFactory::new()->fakeAdAnalyticsResponse();

        $startDate = Carbon::create(2020, 2, 24, 12);
        $endDate = Carbon::create(2020, 3, 24, 12);
        $adIds = ['2291326454'];
        $columns = ['AD_ACCOUNT_ID', 'CAMPAIGN_ID'];
        $granularity = 'DAY';

        $response = PinterestAdAnalytics::withStartDate($startDate)
            ->withEndDate($endDate)
            ->withAdIds($adIds)
            ->withColumns($columns)
            ->withGranularity($granularity)
            ->fetch();

        $adAnalytic = $response[0];

        expect($adAnalytic['DATE'])->toBe('2022-02-19');
        expect($adAnalytic['AD_ID'])->toBe('887291760950');
        expect($adAnalytic['SPEND_IN_DOLLAR'])->toBe(11.701079);
        expect($adAnalytic['TOTAL_CLICKTHROUGH'])->toBe(13);
    }
}

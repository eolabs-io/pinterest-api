<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Factories\AdAccountAnalyticsFactory;
use EolabsIo\PinterestApi\Support\Facades\PinterestAdAccountAnalytics;

class AdAccountAnalyticsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        AdAccountAnalyticsFactory::new()->fakeAdAccountAnalyticsResponse();

        $startDate = Carbon::create(2020, 2, 24, 12);
        $endDate = Carbon::create(2020, 3, 24, 12);
        $columns = ['AD_ACCOUNT_ID', 'CAMPAIGN_ID'];
        $granularity = 'DAY';

        PinterestAdAccountAnalytics::withStartDate($startDate)
            ->withEndDate($endDate)
            ->withColumns($columns)
            ->withGranularity($granularity)
            ->fetch();

        Http::assertSent(function ($request) {
            return Str::startsWith($request->url(), "https://api.pinterest.com/v5/ad_accounts/12345678/analytics") &&
                   $request->method() == "GET" &&
            // Headers
                    $request->hasHeader('Authorization', 'Bearer pina|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw') &&
            // Body
                    $request['start_date'] == '2020-02-24' &&
                    $request['end_date'] == '2020-03-24' &&
                    $request['columns'] == 'AD_ACCOUNT_ID,CAMPAIGN_ID' &&
                    $request['granularity'] == 'DAY';
        });
    }

    /** @test */
    public function it_gets_the_correct_response()
    {
        AdAccountAnalyticsFactory::new()->fakeAdAccountAnalyticsResponse();

        $startDate = Carbon::create(2020, 2, 24, 12);
        $endDate = Carbon::create(2020, 3, 24, 12);
        $columns = ['AD_ACCOUNT_ID', 'CAMPAIGN_ID'];
        $granularity = 'DAY';

        $response = PinterestAdAccountAnalytics::withStartDate($startDate)
            ->withEndDate($endDate)
            ->withColumns($columns)
            ->withGranularity($granularity)
            ->fetch();

        $adAnalytic = $response[0];

        expect($adAnalytic['DATE'])->toBe('2021-04-01');
        expect($adAnalytic['SPEND_IN_DOLLAR'])->toBe(30);
        expect($adAnalytic['TOTAL_CLICKTHROUGH'])->toBe(216);
    }
}

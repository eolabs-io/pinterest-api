<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessListAdsResponse;

class ProcessListAdsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesListAds;


    protected function setUp(): void
    {
        parent::setUp();

        $listAds = $this->createListAds();
        $results = $listAds->fetch();

        (new ProcessListAdsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_ads_response()
    {
        $ad = Ad::first();

        expect($ad->id)->toBe('687195134316');
        expect($ad->name)->toBe('ad-name');
    }
}

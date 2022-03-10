<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessListAdsResponse;

class PerformFetchListAdsTest extends TestCase
{
    use CreatesListAds;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        $adAnalytics = $this->createListAds();

        PerformFetchListAds::dispatch($adAnalytics);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListAds::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListAdsResponse::class, function ($job) {
            return data_get($job->results, 'items.0.id') === '687195134316';
        });

        // Assert that was not called for pagination
        Event::assertNotDispatched(PerformFetchListAds::class);
    }
}

<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessAdAnalyticsResponse;

class PerformFetchAdAnalyticsTest extends TestCase
{
    use CreatesAdAnalytics;

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
    public function it_calls_the_correct_job_without_cursor()
    {
        $adAnalytics = $this->createAdAnalytics();

        PerformFetchAdAnalytics::dispatch($adAnalytics);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchAdAnalytics::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessAdAnalyticsResponse::class, function ($job) {
            return data_get($job->results, '0.AD_ID') === '887291760950';
        });

        // Assert that was not called for Cursor
        Event::assertNotDispatched(PerformFetchAdAnalytics::class);
    }
}

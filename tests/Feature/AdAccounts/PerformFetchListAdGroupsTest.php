<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\PerformFetchListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessListAdGroupsResponse;

class PerformFetchListAdGroupsTest extends TestCase
{
    use CreatesListAdGroups;

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
        $adGroups = $this->createListAdGroups();

        PerformFetchListAdGroups::dispatch($adGroups);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchListAdGroups::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessListAdGroupsResponse::class, function ($job) {
            return data_get($job->results, 'items.0.id') === '2680060704746';
        });

        // Assert that was not called for pagination
        Event::assertNotDispatched(PerformFetchListAdGroups::class);
    }
}

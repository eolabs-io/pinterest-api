<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchAdAnalytics;

class AdInsightsCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_performance_report_artisan_command()
    {
        $this->artisan('pinterest-api:ad-insights
                --start-date=2022-02-1
                --end-date=2022-02-14
                --ad-ids=1234567
                ')
             ->assertExitCode(0);

        // Assert that job was called
        Event::assertDispatched(FetchAdAnalytics::class);
    }
}

<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAdGroups;

class ListAdGroupsCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_list_ad_groups_artisan_command()
    {
        $this->artisan('pinterest-api:list-ad-groups')
             ->assertExitCode(0);

        // Assert that job was called
        Event::assertDispatched(FetchListAdGroups::class);
    }
}

<?php

namespace EolabsIo\PinterestApi\Tests\Feature\AdAccounts;

use EolabsIo\PinterestApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Tests\Concerns\CreatesListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessListAdGroupsResponse;

class ProcessListAdGroupsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesListAdGroups;


    protected function setUp(): void
    {
        parent::setUp();

        $listAdGroups = $this->createListAdGroups();
        $results = $listAdGroups->fetch();

        (new ProcessListAdGroupsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_ad_groups_response()
    {
        $adGroup = AdGroup::first();

        expect($adGroup->id)->toBe('2680060704746');
        expect($adGroup->name)->toBe('Ad Group For Pin: 687195905986');
    }
}

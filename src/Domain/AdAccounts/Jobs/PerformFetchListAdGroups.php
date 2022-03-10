<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAdGroups;

class PerformFetchListAdGroups implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\ListAdGroups */
    public $listAdGroups;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListAdGroups $listAdGroups)
    {
        $this->listAdGroups = $listAdGroups;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listAdGroups->fetch();

        ProcessListAdGroupsResponse::dispatch($results);
        FetchListAdGroups::dispatchIf($this->listAdGroups->hasPagination(), $this->listAdGroups);
    }
}

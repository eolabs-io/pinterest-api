<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\ListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchListAds;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessListAdsResponse;

class PerformFetchListAds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\ListAds */
    public $listAds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListAds $listAds)
    {
        $this->listAds = $listAds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listAds->fetch();

        ProcessListAdsResponse::dispatch($results);
        FetchListAds::dispatchIf($this->listAds->hasPagination(), $this->listAds);
    }
}

<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Events\FetchAdAnalytics;
use EolabsIo\PinterestApi\Domain\AdAccounts\Jobs\ProcessAdAnalyticsResponse;

class PerformFetchAdAnalytics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\PinterestApi\Domain\AdAccounts\AdAnalytics */
    public $adAnalytics;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AdAnalytics $adAnalytics)
    {
        $this->adAnalytics = $adAnalytics;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->adAnalytics->fetch();

        ProcessAdAnalyticsResponse::dispatch($results);
        FetchAdAnalytics::dispatchIf($this->adAnalytics->hasPagination(), $this->adAnalytics);
    }
}
